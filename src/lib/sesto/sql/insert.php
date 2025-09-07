<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_sql_insert
{
  public string $table = '';
  public array $record = [];
  public array $returning = [];

  public function build(bool $prepared = true): string
  {
    $cols = array_keys($this->record);
    if ($prepared) {
      $vals = array_map(fn($col) => ':' . $col, $cols);
    } else {
      $vals = array_values($this->record);
    }

    $sql = "insert into ";
    $sql .= $this->table;
    $sql .= ' (' . implode(', ', $cols) . ') ';
    $sql .= 'values (' . implode(', ', $vals) . ')';
    if (!empty($this->returning)) {
      $sql .= ' returning ' . implode(', ', $this->returning);
    }
    return $sql;
  }


  public function __toString(): string {
    return $this->build;
  }
}