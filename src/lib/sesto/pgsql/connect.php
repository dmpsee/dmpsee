<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/error/handler.php';
require_once SESTO_DIR . '/pgsql/context.php';

function sesto_pgsql_connect(
  string $hostname,
  string $username,
  string $password,
  string $database,
  array $options = []): sesto_pgsql_context
{
  $context = new sesto_pgsql_context();
  $context->error = '';
  /* generate conncetion string */
  $string = 'host=' . $hostname ?? '';

  $port = $options['port'] ?? '';
  if ($port != '') {
    $string .= ' port=' . $port;
  }

  $string .= ' dbname=' . $database ?? '';
  $string .= ' user=' . $username ?? '';
  $string .= ' password=' . $password ?? '';

  if (is_string(($options['client_encoding'] ?? null))) {
    $string .= " options='--client_encoding={$options['client_encoding']}'";
  }
  $context->profile = (bool) ($options['profile'] ?? false);

  /* connect */
  try {
    set_error_handler('sesto_error_handler');
    $context->connection = pg_connect($string);
  } catch (exception $ex) {
    $context->connection = false;
    $context->error = $ex->getmessage();
  } finally {
    restore_error_handler();
  }
  return $context;
}
