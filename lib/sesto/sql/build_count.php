<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/sql/select.php';
require_once SESTO_DIR . '/sql/build_where.php';

function sesto_sql_build_count(sesto_sql_select $select): string
{
  $sql = 'select';
  $sql .= ' count(1) as num_rows';
  $sql .= ' from ' . $select->from;
  if (!empty($select->join)) {
    $sql .= ' ' . implode(' ', $select->join);
  }
  if (!empty($select->where)) {
    $sql .= ' where ' . sesto_sql_build_where($select->where);
  }
  if (!empty($select->group)) {
    $sql .= ' group by ' . implode(', ', $select->group);
  }
  return $sql;
}