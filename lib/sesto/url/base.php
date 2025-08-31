<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_url_base(): string
{
  $url = $_SERVER['SCRIPT_FILENAME'];
  $url = preg_replace('#' . rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/') . '#', '', $url, 1);
  $url = preg_replace('#' . basename($_SERVER['SCRIPT_FILENAME'] ?? '') . '#', '', $url, 1);
  if ('/' != $url) {
    $url = rtrim($url, '/');
  }
  return $url;
}
