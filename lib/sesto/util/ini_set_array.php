<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_ini_set_array(array $options): array
{
  $old_values = [];
  foreach ($options ?? [] as $option => $value) {
    if (is_string($option)) {
      $old_values[$option] = ini_set($option, $value);
    }
  }
  return $old_values;
}


// Returns the old value on success, false on failure.