<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require SESTO_DIR . '/log/label.php';

function sesto_log_std(string $message, int $priority = LOG_INFO, array $context = [], int $log_level = LOG_INFO): bool
{
  if ($priority > $log_level) {
    return true;
  }

  $log_array = [gmdate('c'), sesto_log_label($priority), $message];
  if (!empty($context)) {
    $log_array[] = $context;
  }

  $log_string = json_encode($log_array, JSON_UNESCAPED_SLASHES);

  if ($log_string === false) {
    file_put_contents('php://stderr', "ERROR: Failed to encode log message\n", FILE_APPEND);
    return false;
  }

  if (file_put_contents('php://stdout', $log_string . PHP_EOL, FILE_APPEND) === false) {
    file_put_contents('php://stderr', "ERROR: Failed to write log to stdout.\n", FILE_APPEND);
    return false;
  }

  return true;
}
