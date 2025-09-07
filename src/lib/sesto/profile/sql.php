<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_profile_sql(string $query = null, float $elapsed = 0.0, array $params = [], string $type = 'query'): null|array
{
  static $sqls = [];
  if (null === $query) {
    return $sqls;
  } else {
    $sqls[] = ['sql' => $query, 'elapsed' => $elapsed, 'params' => $params, 'type' => $type];
    return null;
  }
}
