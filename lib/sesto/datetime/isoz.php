<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_datetime_isoz(datetime $datetime): string
{
  $out = $datetime->format('Y-m-d\TH:i:s');
  if ('UTC' === $datetime->gettimezone()->getname()) {
    $out .= 'Z';
  } else {
    $out .= $datetime->format('P');
  }
  return $out;
}
