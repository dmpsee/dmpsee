<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_print_r($expression, bool $return = false): string
{
  $out = '';
  if (is_null($expression)) {
    $out = 'null';
  } elseif (is_bool($expression)) {
    $out = '(boolean) ' . ($expression ? 'true' : 'false');
  } elseif (is_int($expression) || is_float($expression) || is_double($expression)) {
    $out = '(' . gettype($expression) . ') ' . $expression;
  } elseif (is_string($expression)) {
    $out = sprintf('(string c%d,b%d) %s', mb_strlen($expression), strlen($expression), $expression);
  } elseif (is_array($expression)) {
    $out = print_r($expression, TRUE);
  } else {
    $out = '(' . gettype($expression) . ') ' . print_r($expression, TRUE);
  }
  if ($return) {
    return $out;
  }
  print $out;
  return '';
}
