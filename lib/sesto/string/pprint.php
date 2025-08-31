<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_json_pprint(string $json): string
{
  $data = json_decode($json);
  if (null !== $data) {
    $out = json_encode($data, JSON_PRETTY_PRINT);
    if (false === $out) {
      $out = '';
    }
  } else {
    $out = '';
  }
  return $out;
}
