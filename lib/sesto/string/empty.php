<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_string_empty(string $input): bool
{
  return !(bool) preg_match('/\S/', $input);
}
