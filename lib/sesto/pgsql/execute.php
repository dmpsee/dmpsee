<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/util/registry.php';
require_once SESTO_DIR . '/profile/sql.php';

function sesto_pgsql_execute(sesto_pgsql_context $context, string $stmtname, array $params): pgsql\result|false
{
  if ($context->profile) {
    $start = microtime(true);
    $result = pg_execute($context->connection, $stmtname, $params);
    sesto_profile_sql($stmtname, microtime(true) - $start, $params, 'execute');
  } else {
    $result = pg_execute($context->connection, $stmtname, $params);
  }
  return $result;
}
