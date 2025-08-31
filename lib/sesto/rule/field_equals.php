<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_rule_field_equals(string $value, string $field, array $input): bool
{
  return isset($input[$field]) ? $value === $input[$field] : false;
}
