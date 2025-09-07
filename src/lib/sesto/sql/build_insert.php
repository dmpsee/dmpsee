<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/sql/insert.php';

function sesto_sql_build_insert(sesto_sql_insert $insert, bool $prepared = true): string
{
  $cols = array_keys($insert->record);
  if ($prepared) {
    $vals = array_map(fn($col) => ':' . $col, $cols);
  } else {
    $vals = array_values($insert->record);
  }

  $sql = "insert into ";
  $sql .= $insert->table;
  $sql .= ' (' . implode(', ', $cols) . ') ';
  $sql .= 'values (' . implode(', ', $vals) . ')';
  if (!empty($insert->returning)) {
    $sql .= ' returning ' . implode(', ', $insert->returning);
  }
  return $sql;
}