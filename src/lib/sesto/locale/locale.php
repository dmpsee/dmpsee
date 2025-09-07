<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_locale
{
  public string $locale = '';
  public string $primary_language = '';
  public string $region = '';

  public function __construct(string $locale, string $primary_language = '', string $region = '')
  {
    $this->locale = $locale;
    $this->primary_language = $primary_language;
    $this->region = $region;
  }
}
