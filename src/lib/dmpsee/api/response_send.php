<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once DMPSEE_DIR . '/api/response.php';

function send_reponse(dmpsee_api_response $response)
{
  foreach (sesto_http_header_json() as $header) {
    header($header);
  }
  echo json_encode($response, JSON_FORCE_OBJECT);
}
