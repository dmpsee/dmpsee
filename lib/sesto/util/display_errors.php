<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_display_errors(bool $display = false): void
{
  if ($display) {
    ini_set('display_errors', 'true');
    ini_set('display_startup_errors', 'true');
    error_reporting(E_ALL);
  } else {
    ini_set('display_errors', 'false');
    ini_set('display_startup_errors', 'false');
    error_reporting(0);
  }
}
