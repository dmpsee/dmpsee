<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_import(string $name): mixed
{
  $path = '';
  $vendor = '';
  $vendor_found = false;
  for ($i = 0; $i <= strlen($name) - 1; $i++) {
    if (!$vendor_found && '.' !== $name[$i]) {
      $vendor .= $name[$i];
    } elseif (!$vendor_found && '.' === $name[$i]) {
      $path .= ((string) sesto_path($vendor)) . DIRECTORY_SEPARATOR;
      $vendor_found = true;
    } elseif ($vendor_found && '.' === $name[$i]) {
      $path .= DIRECTORY_SEPARATOR;
    } else {
      $path .= $name[$i];
    }
  }
  return $vendor_found ? require_once $path . '.php' : null;
}
