<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_app_error_cli(throwable $throwable, array $config, array $args = []): void
{
  $extended_info = is_bool($config['sesto_error_extended_info'] ?? null) ?: false;
  echo "\n--- throwable ---\n";
  echo sprintf("%s: %s\n", $throwable->getcode(), $throwable->getmessage());
  if ($extended_info) {
    echo sprintf("\tThrowable: %s\n", print_r($throwable, true));
  }
}
