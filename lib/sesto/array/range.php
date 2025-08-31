<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_array_range(
  $start,
  $end,
  $step = 1,
  string $format_key = null,
  string $format_value = null): array
{
  $data = [];
  foreach (range($start, $end, $step) as $value) {
    if (null === $format_key) {
      $key = $value;
    } else {
      $key = sprintf((string) $format_key, $value);
    }
    if (null !== $format_value) {
      $value = sprintf((string) $format_value, $value);
    }
    $data[$key] = $value;
  }
  return $data;
}
