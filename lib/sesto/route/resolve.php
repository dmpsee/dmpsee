<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

require_once SESTO_DIR . '/route/struct.php';
require_once SESTO_DIR . '/url/base.php';
require_once SESTO_DIR . '/url/path.php';
require_once SESTO_DIR . '/url/relative.php';

function sesto_route_resolve(string $url_base = null, string $url_path = null): array
{
  $route = sesto_route_struct();
  $route['url_base'] = null === $url_base ? sesto_url_base() : $url_base;
  $route['url_path'] = null === $url_path ? sesto_url_path() : $url_path;
  $route['url_relative'] = sesto_url_relative($route['url_path'], $route['url_base']);
  if ('/' == $route['url_relative'][mb_strlen($route['url_relative']) - 1]) {
    $pinfo = pathinfo($route['url_relative'] . 'index');
  } else {
    $pinfo = pathinfo($route['url_relative']);
  }
  $route['dirname'] = $pinfo['dirname'] ?? '';
  $route['basename'] = $pinfo['basename'] ?? '';
  $route['filename'] = $pinfo['filename'] ?? 'index';
  $route['extension'] = $pinfo['extension'] ?? '';
  if ('/' === $route['dirname']) {
    $route['id'] = '/' . $route['filename'];
  } else {
    $route['id'] = $route['dirname'] . '/' . $route['filename'];
  }

  return $route;
}
