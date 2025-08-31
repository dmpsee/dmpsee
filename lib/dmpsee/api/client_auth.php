<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once DMPSEE_DIR . '/api/response.php';

function dmpsee_api_client_auth(string $type, vinti_client $vinti_client, dmpsee_api_response $response)
{
  $client_api_id = $_SERVER['HTTP_X_API_ID'] ?? '';
  $client_api_key = $_SERVER['HTTP_X_API_KEY'] ?? '';

  if ($client_api_id === '' || $client_api_key === '') {
    $api_response->code = SESTO_HTTP_BAD_REQUEST;
    $api_response->message = sesto_http_status_codes()[$api_response->code];
    return;
  }

  $vinti_result = vinti_exec($vinti_client, vinti_fi_get($type, $client_api_id));



  // sesto_d($vinti_result, 'vinti_result');
  if ($vinti_result->code === 200) {
    $client = json_decode($vinti_result->message, true);
    if (($client['api-id'] ?? '') !== $client_api_id || ($client['api-key'] ?? '') !== $client_api_key) {
      $api_response->code = SESTO_HTTP_UNAUTHORIZED;
      $api_response->message = sesto_http_status_codes()[$api_response->code];
    }
  } else {
    $api_response->code = SESTO_HTTP_INTERNAL_SERVER_ERROR;
    $api_response->message = sesto_http_status_codes()[$api_response->code];
  }


}
