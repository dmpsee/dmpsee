<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_sql_select {

  public array $cols = [];
  public string $from = '';
  public array $join = [];
  public array $where = [];
  public array $group = [];
  public array $order = [];
  public int $limit = 0;
  public int $offset = 0;

  public function build(): string
  {
    $sql = 'select';
    $sql .= ' ' . implode(', ', $this->cols);
    $sql .= ' from ' . $this->from;
    if (!empty($this->join)) {
      $sql .= ' ' . implode(' ', $this->join);
    }
    if (!empty($this->where)) {
      $sql .= ' where ' . implode(' and ', $this->where);
    }
    if (!empty($this->group)) {
      $sql .= ' group by ' . implode(', ', $this->group);
    }
    if (!empty($this->order)) {
      $sql .= ' order by ' . implode(', ', $this->order);
    }
    if ($this->limit > 0) {
      $sql .= ' limit ' . $this->limit;
    }
    if ($this->offset > 0) {
      $sql .= ' offset ' . $this->offset;
    }
    return $sql;
  }
}
