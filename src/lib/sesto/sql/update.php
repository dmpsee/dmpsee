<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_sql_update
{
  public string $table = '';
  public array $record = [];
  public array $where = [];
  public array $returning = [];

  function build(bool $prepared = true): string
  {
    $set = [];
    foreach ($this->record as $field => $value) {
      if ($prepared) {
        if (is_array($value)) {
          $set[] = $field . ' = ' . $value[0];
        } else {
          $set[] = $field . ' = :' . $field;
        }
      } else {
        $set[] = $field . ' = ' . $value;
      }
    }
    $sql = 'update ' . $this->table . ' set ' . implode(', ', $set);
    if (!empty($this->where)) {
      $sql .= ' where ' . implode(' and ', $this->where);
    }
    if (!empty($this->returning)) {
      $sql .= ' returning ' . implode(', ', $this->returning);
    }
    return $sql;
  }

  public function __toString(): string {
    return $this->build;
  }
}