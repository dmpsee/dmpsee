<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_log_label(int $priority): string
{
  return match ($priority) {
    LOG_EMERG   => 'EMERG',
    LOG_ALERT   => 'ALERT',
    LOG_CRIT    => 'CRIT',
    LOG_ERR     => 'ERR',
    LOG_WARNING => 'WARNING',
    LOG_NOTICE  => 'NOTICE',
    LOG_INFO    => 'INFO',
    LOG_DEBUG   => 'DEBUG',
    default     => 'UNKNOWN',
  };
}
