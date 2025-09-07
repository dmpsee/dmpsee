<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_config_php(string $path): false|array
{
  if (is_file($path) && is_readable($path)) {
    $result = include_once($path);
    if (isset($config) && is_array($config)) {
      $result = $config;
    } elseif (!is_array($result)) {
      $result = false;
    }
  } else {
    $result = false;
  }
  return $result;
}