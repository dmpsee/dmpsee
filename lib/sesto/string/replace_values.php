<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_string_replace_values(string $input, array $values, string $lhs = '{', string $rhs = '}'): string
{
  $replace = [];
  foreach ($values as $key => $val) {
    if (is_object($val) && method_exists($val, '__toString')) {
      $replace[$lhs . $key . $rhs] = (string) $val;
    } elseif (is_numeric($val) || is_string($val) || is_bool($val)) {
      $replace[$lhs . $key . $rhs] = $val;
    }
  }
  return strtr($input, $replace);
}
