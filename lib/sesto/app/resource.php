<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_resource(?string $name = null, $value = null): mixed
{
  /* init */
  static $cache = [];
  if (null === $name) {
    /* return all cache */
    return $cache;
  }
  if (func_num_args() === 2) {
    if (null === $value) {
      /* delete */
      unset($cache[$name]);
    } else {
      /* set */
      $cache[$name] = $value;
    }
    return null;
  } else {
    /* get */
    if (!isset($cache[$name])) {
      return null;
    } else {
      /* get */
      if (is_string($cache[$name])) {
        /* auto init the resource */
        if ($cache[$name][0] == '&') {
          $name = substr($cache[$name], 1);
          $resource = sesto_resource($name);
        } else {
          $path = $cache[$name] . ('php' != pathinfo($cache[$name], PATHINFO_EXTENSION) ? '.php' : '');
          if (is_file($path) && is_readable($path)) {
            $resource = include $path;
          } else {
            $resource = null;
          }
        }
        $cache[$name] = $resource;
      }
      return $cache[$name] ?? null;
    }
  }
}
