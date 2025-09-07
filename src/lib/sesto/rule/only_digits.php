<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_rule_only_digits(string $value): bool
{
  return 0 === preg_match('/[^0-9]/', $value);
}
