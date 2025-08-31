<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/scd/call.php';

final class sesto_hook_simple
{
  protected array $store;
  protected array $hooks;
  protected static $instance;

  public static function getme(): sesto_hook_simple
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    $this->hooks = [];
  }

  private function __clone()
  {

  }

  public function get(string $name = null): false|array
  {
    return ($name === null) ? $this->hooks : ($this->hooks[$name] ?? []);
  }

  public function has(string $name): bool
  {
    return isset($this->hooks[$name]);
  }

  public function del(string $name): void
  {
    unset($this->hooks[$name]);
  }

  public function list(string $name): array
  {
    $list = [];
    foreach ($this->get($name) as $block) {
        foreach ($block as $callback) {
          $list[] = $callback;
        }
    }
    return $list;
  }

  public function attach(string $name, sesto_scd $scd, int $priority = 50): void
  {
    $this->hooks[$name][$priority][] = $scd;
    ksort( $this->hooks[$name], SORT_NUMERIC);
  }

  public function filter(string $name, $value): mixed
  {
    $filtered = $value;
    $calls = $this->hooks[$name] ?? [];
    if (!empty($calls)) {
      $args = [];
      if (func_num_args() > 3) {
        $args = array_slice(func_get_args(), 2);
      }
      foreach ($calls as $block) {
        foreach ($block as $scd) {
          $filtered = sesto_scd_call($scd, $filtered, $args);
        }
      }
    }
    return $filtered;
  }

  public function function(string $name, ...$args): mixed
  {
    $result = null;
    $calls = $this->hooks[$name] ?? [];
    foreach ($calls as $block) {
      foreach ($block as $scd) {
        $result = sesto_scd_call($scd, ...$args);
      }
    }
    return $result;
  }

  public function procedure(string $name, ...$args): void
  {
    $calls = $this->hooks[$name] ?? [];
    foreach ($calls as $block) {
      foreach ($block as $scd) {
        sesto_scd_call($scd, ...$args);
      }
    }
  }
}
