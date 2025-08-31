<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_session_alerts
{

  public readonly string $namespace;
  private array $alerts;

  public function __construct(string $namespace)
  {
    $this->namespace = $namespace;
    $this->read();
  }

  public function all(): array
  {
    return $this->alerts;
  }

  public function add(string $type, string $message): sesto_session_alerts
  {
    $this->alerts[] = ['type' => $type, 'message' => $message];
    return $this;
  }

  public function read(): sesto_session_alerts
  {
    $this->alerts = $_SESSION[$this->namespace]['alerts'] ?? [];
    return $this;
  }

  public function write(): sesto_session_alerts
  {
    $_SESSION[$this->namespace]['alerts'] = $this->alerts;
    return $this;
  }

  public function delete(): void
  {
    $_SESSION[$this->namespace]['alerts'] = [];
  }
}
