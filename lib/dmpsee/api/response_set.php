<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once DMPSEE_DIR . '/api/response.php';
require_once SESTO_DIR . '/http/status_codes.php';

function dmpsee_reponse_set(dmpsee_api_response $response, int $code, ?string $message = null): void
{
  if ($message === null) {
    $message = sesto_http_status_codes()[$api_response->code];
  }
  $response->code = $code;
  $response->message = $message;
}
