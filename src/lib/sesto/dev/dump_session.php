<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/dev/dump.php';

function sesto_dump_session(bool $return = false): string
{
  $out = '';
  if (session_id() == '') {
    $out .= sesto_dump('Session not started', 'nf_ds', true);
  } else {
    $out .= sesto_dump(session_id(), 'Session id', true);
    $out .= sesto_dump(session_name(), 'Session name', true);
    $out .= sesto_dump(session_get_cookie_params(), 'Cookie parameters', true);
    $out .= sesto_dump($_SESSION, 'Session-content', true);
  }
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}

function sesto_ds(bool $return = false): string
{
  return sesto_dump_session($return);
}
