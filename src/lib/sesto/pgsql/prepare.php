<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/util/registry.php';
require_once SESTO_DIR . '/profile/sql.php';

function sesto_pgsql_prepare(sesto_pgsql_context $context, string $stmtname, string $query): pgsql\result|false
{
  if ($context->profile) {
    $start = microtime(true);
    $result = pg_prepare($context->connection, $stmtname, $query);
    sesto_profile_sql($query, microtime(true) - $start, [], 'prepare');
  } else {
    $result = pg_prepare($context->connection, $stmtname, $query);
  }
  return $result;
}
