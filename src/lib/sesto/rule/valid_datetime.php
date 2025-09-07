<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_rule_valid_datetime(string $value, string $format): bool
{
  $result = datetime::createfromformat($format, $value);
  if (false !== $result) {
    $errors = datetime::getlasterrors();
    if (0 === $errors['warning_count'] && 0 === $errors['error_count']) {
      $result = true;
    } else {
      $result = false;
    }
  }
  return $result;
}
