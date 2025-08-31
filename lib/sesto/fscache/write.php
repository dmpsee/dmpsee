<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_fscache_write(string $path, string $value): bool
{
  return is_int(file_put_contents($path, $value));
}
