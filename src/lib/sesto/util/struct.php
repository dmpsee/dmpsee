<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class sesto_struct
{

  public function __get(string $name): mixed
  {
    throw new exception("__get($name) not allowed on Sesto struct");
  }

  public function __set($name, $value)
  {
    throw new exception("__set($name) not allowed on Sesto struct");
  }

  public function __construct(array $config = [])
  {
    foreach ($config as $key => $value) {
      if (isset($this->$key)) {
        $this->$key = $value;
      }
    }
  }
}
