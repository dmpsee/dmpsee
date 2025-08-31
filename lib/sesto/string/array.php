<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_replace_array(string $pattern, array $input): string
{
  $output = $input;
  foreach ($input as $value) {
    $matches = [];
    preg_match_all($pattern, $value, $matches);
    foreach ($matches[0] as $token) {
      $key = trim($token, '%');
      $output = str_replace($token, $value, $output);
    }
  }
  return $output;
}
