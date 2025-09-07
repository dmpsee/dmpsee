<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_pgsql_parse(string $query, array $params): array
{
  $parsed_params = [];
  $parsed_query = $query;
  $position = 1;

  foreach ($params as $name => $value) {
    $parsed_params[$position] = $value;
    $parsed_query = str_replace(':' . $name, '$' . $position, $parsed_query);
    $position++;
  }
  return [$parsed_query, $parsed_params];
}