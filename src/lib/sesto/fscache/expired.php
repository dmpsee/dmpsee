<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_fscache_expired(string $path, int $ttl): bool
{
  $created = file_exists($path) ? filemtime($path) : 0;
  return time() > $ttl + $created;
}
