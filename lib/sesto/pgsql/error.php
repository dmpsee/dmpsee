<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_pgsql_error($conn = null): string
{
  $error = '';
  if ($conn instanceof pgsql\connection) {
    $error = (string) pg_last_error($conn);
    $pos = strpos($error, "\n");
    if (false !== $pos) {
      $error = substr($error, 0, $pos);
    }
  }
  return $error;
}
