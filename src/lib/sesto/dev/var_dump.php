<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_var_dump($var, string $label = '', bool $return = false): string
{
  $block_start = '<pre>';
  $block_end = '</pre>';
  $bold_start = '<strong>';
  $bold_end = '</strong>';
  if ('cli' == php_sapi_name()) {
    $block_start = '';
    $block_end = "\n";
    $bold_start = '';
    $bold_end = '';
  }
  $out = $block_start;
  $bt = debug_backtrace();
  //$idx = $bt[0]['function'] == 'sesto_dump' ? 0 : 1;
  $idx = 1;
  $out .= '[' . pathinfo($bt[$idx]['file'], PATHINFO_FILENAME);
  $out .= ':' . $bt[$idx]['line'] . ']';
  if ('' != $label) {
    $out .= ' ' . $bold_start . $label . $bold_end;
  }
  ob_start();
  var_dump($var);
  $out .= ': ' . str_replace("=>\n  ", ' => ', ob_get_contents());
  ob_end_clean();
  $out .= $block_end;
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}
