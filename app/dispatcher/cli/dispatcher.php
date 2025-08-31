<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

ini_set('display_errors', 'true');
ini_set('track_errors', 'true');
ini_set('display_startup_errors', 'true');
error_reporting(E_ALL);

define('ME', microtime(true));
define('SESTO_MEM_START', memory_get_usage(true));

/* setup the system dir */
$sys_dir = realpath(__DIR__ . '/../../..');

require $sys_dir . '/lib/sesto/initme.php';
// require $sys_dir . '/app/dispatcher/lib/dmpsee/engine.php';
require SESTO_DIR . '/app/exec.php';

list($exit_code, $error) = sesto_app_exec(
  $sys_dir,
  (new sesto_scd('dmpseee_dispatcher_engine', [], $sys_dir . '/app/dispatcher/lib/dmpsee/engine.php')),
  [],
  'dispatcher',
  true);

if ($error !== '') {
  echo $error;
}
