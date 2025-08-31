<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_mysql_quote(mysqli $connection, string $value): string
{
  if (is_int($value) || is_float($value)) {
    return $value;
  }
  if (!is_string($value)) {
    throw new exception('Invalid type');
  }
  return "'" . mysqli_real_escape_string($connection, $value) . "'";
}
