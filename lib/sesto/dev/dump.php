<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/dev/print_r.php';

function sesto_dump($expression, string $label = '', bool $return = false): string
{
  $block_start = '<pre>';
  $block_end = '</pre>';
  $bold_start = '<b>';
  $bold_end = '</b>';
  if ('cli' == php_sapi_name()) {
    $block_start = '';
    $block_end = "\n";
    $bold_start = '';
    $bold_end = '';
  }
  $out = $block_start;
  $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
  if (isset($bt[1]) && isset($bt[1]['function']) && 'sesto_d' === $bt[1]['function']) {
    $idx = 1;
  } else {
    $idx = 0;
  }
  $out .= '[' . pathinfo($bt[$idx]['file'], PATHINFO_FILENAME);
  $out .= ':' . $bt[$idx]['line'] . ']';
  if ('' != $label) {
    $out .= ' ' . $bold_start . $label . $bold_end;
  }
  $out .= ': ' . sesto_print_r($expression, true);
  $out .= $block_end;
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}

function sesto_d($expression, string $label = '', bool $return = false): string
{
  return sesto_dump($expression, $label, $return);
}
