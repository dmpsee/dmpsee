<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_rule_less_than($value, $min, bool $equal = false): bool
{
  if ($equal) {
    return $value <= $min;
  } else {
    return $value < $min;
  }
}
