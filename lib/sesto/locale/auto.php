<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_locale_auto(): string|false
{
  $env = getenv('cli' != php_sapi_name() ? 'HTTP_ACCEPT_LANGUAGE' : 'LANG');
  return is_string($env) ? locale_accept_from_http($env) : false;
}
