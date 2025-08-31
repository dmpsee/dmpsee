<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_url_relative(string $url_path, string $url_base): string
{
  $result = $url_path;
  if ('/' !== $url_base) {
    $result = preg_replace('#' . $url_base . '#', '', $url_path, 1);
  }
  return $result;
}
