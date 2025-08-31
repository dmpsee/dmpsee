<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_sqle_select implements stringable
{

  public string $stmt_name = '';
  public array $col = [];
  public string $from = '';
  public array $join = [];
  public array $where = [];
  public array $group = [];
  public array $order = [];
  public int $limit = 0;
  public int $offset = 0;

  public function __construct(string $stmt_name = '')
  {
    $this->stmt_name = $stmt_name;
  }

  public function col(string $col, string $alias = null)
  {
    $this->col[] = $col . (null !== $alias) ? ' as ' . $alias : '';
  }

  public function sql(): string
  {
    $sql = 'select' . PHP_EOL;
    $sql .= '  ' . implode(',  ' . PHP_EOL . '  ', $this->col) . PHP_EOL;
    $sql .= 'from ' . $this->from . PHP_EOL;
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

  public function count(): string
  {
    $sql = 'select' . PHP_EOL;
    $sql .= ' count(1) as num_rows' . PHP_EOL;
    $sql .= 'from ' . $this->from . PHP_EOL;
    if (!empty($this->join)) {
      $sql .= ' ' . implode(' ', $this->join);
    }
    if (!empty($this->where)) {
      $sql .= ' where ' . implode(' and ', $this->where);
    }
    if (!empty($this->group)) {
      $sql .= ' group by ' . implode(', ', $this->group);
    }
    return $sql;
  }

  public function __toString(): string
  {
    return $this->sql();
  }
}
