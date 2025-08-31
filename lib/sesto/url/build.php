<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/url/url.php';

function sesto_url_build(sesto_url $url, string $destination, array $params = []): string
{
  if ($url->url_base !== '/') {
    $out = $url->url_base . '/' . ltrim($destination, '/');
  } else {
    $out = '/' . ltrim($destination, '/');
  }
  if ($params !== []) {
    $out .= '?' . http_build_query($params);
  }
  return $out;
}


