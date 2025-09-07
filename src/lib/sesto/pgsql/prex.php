<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/pgsql/parse.php';
require_once SESTO_DIR . '/pgsql/prepare.php';
require_once SESTO_DIR . '/pgsql/execute.php';

function sesto_pgsql_prex(sesto_pgsql_context $context, string $stmt_name, string $query, array $params): pgsql\result|false
{
  list($parsed_query, $parsed_params) = sesto_pgsql_parse($query, $params);

  $result = sesto_pgsql_prepare($context, $stmt_name, $parsed_query);
  if ($result instanceof pgsql\result) {
    $result = sesto_pgsql_execute($context, $stmt_name, $parsed_params);
  }
  return $result;
}
