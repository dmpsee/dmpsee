<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_config_ini(string $path, bool $process_sections = true, int $scanner_mode = INI_SCANNER_TYPED): false|array
{
  if (is_file($path) && is_readable($path)) {
    $config = parse_ini_file($path, $process_sections, $scanner_mode);
  } else {
    $config = false;
  }
  return $config;
}
