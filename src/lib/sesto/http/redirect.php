<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_http_redirect(string $url, int $response_code = 303): void
{
  if (!(bool) preg_match('/\S/', $url)) {
    throw new exception('Empty redirect url');
  }
  header("Status: " . $response_code, true);
  header("Location: " . $url, true, $response_code);
}
