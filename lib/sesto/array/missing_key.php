<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_array_missing_key(array $expected, array $input): array
{
  $missing = [];
  foreach ($expected as $name) {
    if (!array_key_exists($name, $input)) {
      $missing[] = $name;
    }
  }
  return $missing;
}
