<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types = 1);

require_once SESTO_DIR . '/tld/exists.php';

function sesto_rule_email_tld(string $value): bool
{
  $result = filter_var($value, FILTER_VALIDATE_EMAIL);
  if (false !== $result) {
    $parts = explode('@', $value);
    $domain =  end($parts);
    $parts = explode('.', $domain);
    $result = sesto_tld_exists(end($parts));
  }
  return $result;
}

