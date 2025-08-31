<?php

declare(strict_types=1);
//
require_once SESTO_DIR . '/view/render.php';
require_once SESTO_DIR . '/http/header_json.php';
require_once SESTO_DIR . '/app/resource.php';

require_once DMPSEE_DIR . '/api/response.php';
require_once DMPSEE_DIR . '/api/response_send.php';
require_once VINTI_DIR . '/command.php';
require_once VINTI_DIR . '/fi_get.php';
require_once VINTI_DIR . '/da_ins.php';
require_once VINTI_DIR . '/exec.php';

function bella_exec(dmpsee_api_app $app)
{
  $api_response = new dmpsee_api_response();
  $vinti_client = sesto_resource('vinti');

  /* authorisation */
  $client_api_id = $_SERVER['HTTP_X_API_ID'] ?? uniqid();
  $client_api_key = $_SERVER['HTTP_X_API_KEY'] ?? uniqid();
  if ($client_api_id === '' || $client_api_key === '') {
    dmpsee_reponse_set($api_response, SESTO_HTTP_BAD_REQUEST);
  } else {
    $vinti_result = vinti_exec($vinti_client, vinti_fi_get('publisher', $client_api_id));

    if ($vinti_result->code === SESTO_HTTP_OK) {
      $client = json_decode($vinti_result->message, true);
      if ($client['api-id'] === $client_api_id && $client['api-key'] === $client_api_key) {
        /* request */
        $request_json = file_get_contents('php://input') ?: '';
        if ($request_json === '') {
          $api_response->code = SESTO_HTTP_BAD_REQUEST;
          $api_response->message = sesto_http_status_codes()[$api_response->code];
        } else {
          $request = json_decode($request_json, true) ?? [];
          if ($request === null) {
            $api_response->code = SESTO_HTTP_BAD_REQUEST;
            $api_response->message = sesto_http_status_codes()[$api_response->code];
          }
        }
      } else {
        dmpsee_reponse_set($api_response, SESTO_HTTP_UNAUTHORIZED);
      }
    } else {
      dmpsee_reponse_set($api_response, SESTO_HTTP_INTERNAL_SERVER_ERROR);
    }

  }

  if ($api_response->code !== SESTO_HTTP_OK) {
    send_reponse($api_response);
    return;
  }


  $vinti_result = vinti_exec($vinti_client, vinti_fi_get('publisher', $client_api_id));


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

  $vinti_result = vinti_exec($vinti_client, vinti_da_ins('queue/new', json_encode($request['payload'])));
  if ($vinti_result->code === SESTO_HTTP_OK) {
    $api_response->code = SESTO_HTTP_OK;
    $api_response->message = sesto_http_status_codes()[$api_response->code];
  } else {
    $api_response->code = SESTO_HTTP_INTERNAL_SERVER_ERROR;
    $api_response->message = sesto_http_status_codes()[$api_response->code];
  }
  send_reponse($api_response);
}
