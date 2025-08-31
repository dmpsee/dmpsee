<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_html_void(): array
{
  return [
    'area' => true,
    'base' => true,
    'br' => true,
    'col' => true,
    'embed' => true,
    'hr' => true,
    'img' => true,
    'input' => true,
    'link' => true,
    'meta' => true,
    'param' => true,
    'source' => true,
    'track' => true,
    'wbr' => true
  ];
}
