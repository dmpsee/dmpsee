<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_error_handler(int $errno, string $errstr, ?string $file = null, ?int $line = null)
{
  if (!(error_reporting() & $errno)) {
    // This error code is not included in error_reporting, so let it fall
    // through to the standard PHP error handler
    return false;
  }
  throw new errorexception($errstr, 0, $errno, $file, $line);
}
