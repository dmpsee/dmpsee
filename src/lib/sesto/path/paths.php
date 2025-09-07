<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_paths(string $name = null, string $dir = null): mixed
{
  static $cache = [];
  if (null === $name && null === $dir) {
    /* all */
    return $cache;
  } elseif (null !== $dir) {
    /* set */
    $cache[$name] = $dir;
    return null;
  } else {
    /* get */
    return $cache[$name] ?? '';
  }
}
