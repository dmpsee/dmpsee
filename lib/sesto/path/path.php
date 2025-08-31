<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/path/paths.php';

function sesto_path(...$segments): string
{
  $is_macro = isset($segments[0][0]) && ($segments[0][0] === ':');
  if ($is_macro) {
    $segments[0] = sesto_paths(substr($segments[0], 1));
  }
  return implode(DIRECTORY_SEPARATOR, $segments);
}