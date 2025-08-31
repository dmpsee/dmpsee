<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/dev/dump.php';

function sesto_dump_app_error(throwable $throwable, array $args = []): string
{
  if (ob_get_length() > 0) {
    @ob_clean();
    @ob_end_clean();
  }
  return sesto_dump(['throwable' => $throwable, 'args' => $args]);
}
