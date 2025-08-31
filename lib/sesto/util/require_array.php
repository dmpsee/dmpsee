<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_require_array(array $config, bool $once = true): void
{
  foreach ($config as $path) {
    $once ? require_once $path : require $path;
  }
}
