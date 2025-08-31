<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_memcached_write(Memcached $server, string $key, $value, int $ttl = 0): bool
{
  $result = $server->set($key, $value, $ttl);
  return $result && Memcached::RES_SUCCESS == $server->getresultcode();
}
