<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_specialchars(string $string): string
{
  if ('cli' == php_sapi_name()) {
    return $string;
  } else {
    return htmlspecialchars($string, ENT_COMPAT | ENT_HTML5, 'UTF-8');
  }
}
