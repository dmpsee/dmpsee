<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once DMPSEE_DIR . '/api/app.php';
require_once SESTO_DIR . '/url/init.php';
require_once SESTO_DIR . '/scd/call.php';

function dmpseee_api_engine(array $config, array $args = []): void
{

  /* start routing */

  /* define the $app array */
  $app = new dmpsee_api_app();
  $app->config = $config;
  $app->args = $args;

  /* routing */
  $app->url = sesto_url_init();


  /* dispatch */
  $app->controller_dir = SESTO_APP_SRC_DIR;
  if ('/' !== $app->url->dirname) {
    $app->controller_dir .= DIRECTORY_SEPARATOR . trim($app->url->dirname, '/');
  }
  $path_cms_bin = $app->controller_dir . DIRECTORY_SEPARATOR . $app->url->filename . '.php';
  // sesto_d($app);
//  sesto_d($path_cms_bin);
//  die;
  try {
    if (is_file($path_cms_bin) && is_readable($path_cms_bin)) {
      $callable = 'bella_exec';
      $require = $path_cms_bin;
      sesto_scd_call(new sesto_scd($callable, [], $require), $app);
    } else {
      header("Status: " . 404, true);
      echo 'Not Found';
    }
  } catch (throwable $ex) {
    header("Status: " . 500, true);
    echo 'Internal Server Error';
    echo '<pre>';
    print_r($ex);
  }

}
