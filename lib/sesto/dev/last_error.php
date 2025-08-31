<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_last_error()
{
  $e = error_get_last();
  if (null !== $e) {
    echo sprintf(
      '%s Last error: %s%s',
      (php_sapi_name() == "cli" ? '' : '<pre>'),
      print_r($e, true),
      (php_sapi_name() == "cli" ? '' : '</pre>'));
  }
}
