<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_array_extend(array $a, array $b): array
{
  foreach ($b as $key => $value) {
    if (is_array($value)) {
      if (!isset($a[$key])) {
        $a[$key] = $value;
      } else {
        $a[$key] = sesto_array_extend($a[$key], $value);
      }
    } else {
      $a[$key] = $value;
    }
  }
  return $a;
}
