<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types = 1);

function sesto_http_get(): bool
{
  return 'GET' == ($_SERVER['REQUEST_METHOD'] ?? '');
}

