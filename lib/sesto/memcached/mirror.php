<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

require_once SESTO_DIR . '/memcached/read.php';
require_once SESTO_DIR . '/memcached/write.php';

class sesto_memcached_mirror
{

  private Memcached $master;
  private int $num_mirrors = 0;
  private array $mirror = [];

  public function __construct(array $master, array $mirrors = [], array $options = [])
  {

    $this->master = new Memcached();

    // Set the Primary Servers
    $this->master->addServer($master['host'], $master['port']);

    // Set the Options for master
    foreach ($options as $key => $value) {
      $this->master->setOption($key, $value);
    }

    // Set the Mirror
    foreach ($mirrors as $key => $value) {
      $this->mirror[$key] = new memcached();
      $this->mirror[$key]->addServer($value['host'], $value['port']);
      foreach ($options as $key1 => $value1) {
        /* Setting Options for mirrors */
        $this->mirror[$key]->setOption($key1, $value1);
      }
      $this->num_mirrors++;
    }
  }

  public function read($key, &$found = false)
  {
    $data = sesto_memcached_read($this->master, $key, $found);
    if (!$found) {
      foreach ($this->mirror as $mirror) {
        $data = sesto_memcached_read($mirror, $key, $found);
        if ($found) {
          break;
        }
      }
    }
    return $data;
  }

  public function write($key, $data, $ttl = 0): bool
  {
    $result1 = sesto_memcached_write($this->master, $key, $data, $ttl);

    $num_failures = 0;
    $result2 = true;
    if ($this->num_mirrors > 0) {
      foreach ($this->mirror as $mirror) {
        $result = sesto_memcached_write($mirror, $key, $data, $ttl);
        if ($result === false) {
          $num_failures++;
        }
      }
      if ($num_failures === $this->num_mirrors) {
        $result2 = false;
      }
    }

    return $result1 || $result2;
  }

  public function delete($key, $time = 0): bool
  {
    $result1 = $this->master->delete($key, $time);

    $num_failures = 0;
    $result2 = true;
    if ($this->num_mirrors > 0) {
      foreach ($this->mirror as $mirror) {
        $result = $mirror->delete($key, $time);
        if ($result === false) {
          $num_failures++;
        }
      }
      if ($num_failures === $this->num_mirrors) {
        $result2 = false;
      }
    }
    return $result1 || $result2;
  }
}
