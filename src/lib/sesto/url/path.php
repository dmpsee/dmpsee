<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_url_path(): string
{
  $url = $_SERVER['REQUEST_URI'] ?? '';
  /* remove the query string */
  if (isset($_SERVER['QUERY_STRING'])) {
    $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $url);
  }
  return $url;
}
