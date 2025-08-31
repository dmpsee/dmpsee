<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_http_header_sse(): array
{
  return [
    'Content-Type: text/event-stream',
    'Cache-Control: no-cache',
    'Connection: keep-alive'
  ];
}