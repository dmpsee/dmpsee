<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_mysql_connect(
  string $hostname,
  string $database,
  string $username,
  string $password,
  array $options = []): mysqli
{
  $connection = null;
  $port = $options['port'] ?? '';
  $encoding = $options['encoding'] ?? '';

  if ('' !== $port) {
    $connection = @mysqli_connect($hostname, $username, $password, $database, $port);
  } else {
    $connection = @mysqli_connect($hostname, $username, $password, $database);
  }
  if ('' !== $encoding) {
    $connection->set_charset($encoding);
    mysqli_query($connection, "set names '$encoding'");
    mysqli_query($connection, "set character set $encoding");
  }
  return $connection;
}
