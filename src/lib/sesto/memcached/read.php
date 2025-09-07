<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_memcached_read(Memcached $server, string $key, bool &$found = false)
{
  $data = $server->get($key);
  if (Memcached::RES_SUCCESS != $server->getresultcode()) {
    $found = false;
    $data = null;
  } else {
    $found = true;
  }
  return $data;
}
