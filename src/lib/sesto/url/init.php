<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/url/url.php';
require_once SESTO_DIR . '/url/base.php';
require_once SESTO_DIR . '/url/path.php';
require_once SESTO_DIR . '/url/relative.php';

function sesto_url_init(string $url_base = '', string $url_path = ''): sesto_url {
  $url = new sesto_url();
  $url->request_scheme = $_SERVER['REQUEST_SCHEME'] ?? 'https';
  $url->host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  $url->fullhost = $url->request_scheme . '://' . $url->host;

  $url->url_base = $url_base === '' ? sesto_url_base() : $url_base;
  $url->url_path = $url_path === '' ? sesto_url_path() : $url_path;
  $url->url_relative = sesto_url_relative($url->url_path, $url->url_base);
  $len = mb_strlen($url->url_relative);
  $char = $len > 0 ? $url->url_relative[$len - 1] : '';
  if ('/' == $char) {
    $pinfo = pathinfo($url->url_relative . 'index');
  } else {
    $pinfo = pathinfo($url->url_relative);
  }
  $url->dirname = $pinfo['dirname'] ?? '';
  $url->basename = $pinfo['basename'] ?? '';
  $url->filename = $pinfo['filename'] ?? 'index';
  $url->extension = $pinfo['extension'] ?? '';
  if ('/' === $url->dirname) {
    $url->id = '/' . $url->filename;
  } else {
    $url->id = $url->dirname . '/' . $url->filename;
  }
  return $url;
}
