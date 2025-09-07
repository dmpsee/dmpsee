<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_syslog(string $message, int $priority = LOG_INFO): int
{
  static $level = LOG_INFO;
  if ($message === '__set') {
    $level = $priority;
    $result = $level;
  } else if ($message === '__get') {
    $result = $level;
  } else if ($priority <= $level) {
    $result = (int) syslog($priority, $message);
  }
  return $result;
}