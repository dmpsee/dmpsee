<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_rule_string_length(string $value, int $min = null, int $max = null, string $encoding = null): bool
{

  if (null === $min && null === $max) {
    throw new exception("Min and max length not set");
  }
  if (null !== $min && null !== $max) {
    if($min > $max) {
      throw new exception("Min greater than max");
    }
  }

  if (null !== $encoding) {
    $length = mb_strlen($value, $encoding);
  } else {
    $length = mb_strlen($value);
  }

  $is_valid = true;
  if (null !== $min && null === $max) {
    $is_valid = $length >= $min;
  } elseif (null === $min && null !== $max) {
    $is_valid = $length <= $max;
  } else {
    $is_valid = $length >= $min && $length <= $max;
  }
  return $is_valid;
}
