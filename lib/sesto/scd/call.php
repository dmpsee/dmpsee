<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/scd/scd.php';

function sesto_scd_call(sesto_scd $scd): mixed {
  if ($scd->require !== '') {
    require_once $scd->require;
  }
  return call_user_func($scd->callable, ...array_merge($scd->args, array_slice(func_get_args(), 1)));
}