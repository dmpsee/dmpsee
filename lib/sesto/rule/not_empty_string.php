<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/string/empty.php';

function sesto_rule_not_empty_string(string $value): bool
{
  return true !== sesto_string_empty($value);
}
