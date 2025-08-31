<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/locale/locale.php';

function sesto_locale_resolve(string $locale): sesto_locale
{
  return new sesto_locale(
    $locale,
    (string) locale_get_primary_language($locale),
    (string) locale_get_region($locale));
}
