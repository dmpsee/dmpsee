<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/http/status_codes.php';

function sesto_app_error_web(throwable $throwable, array $config, array $args = []): void
{
  $extended_info = is_bool($config['sesto_error_extended_info'] ?? null) ? $config['sesto_error_extended_info'] : false;
  $code = isset(sesto_http_status_codes()[$throwable->getcode()]) ? $throwable->getcode() : 500;
  $message = sesto_http_status_codes()[$code];
  if (!headers_sent()) {
    header("Status: " . $code . ' ' . $message);
    header('Content-Type: text/html; charset=utf-8');
  }
  include 'error_web_page.phtml';
}
