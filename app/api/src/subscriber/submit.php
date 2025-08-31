<?php

declare(strict_types=1);
//
require_once SESTO_DIR . '/view/render.php';
require_once SESTO_DIR . '/http/header_json.php';
require_once SESTO_DIR . '/app/resource.php';

require_once DMPSEE_DIR . '/api/response.php';
require_once VINTI_DIR . '/command.php';
require_once VINTI_DIR . '/da_ins.php';
require_once VINTI_DIR . '/exec.php';

function bella_exec(dmpsee_api_app $app)
{
  // takes raw data from the request
  $json = file_get_contents('php://input');

  $vinti_client = sesto_resource('vinti');

  $data = [
    'id' => rand(1,1000),
    'name' => 'abcd',
  ];

  $vinti_command = vinti_da_ins('event', json_encode($data));

  // sesto_d($app);
  // sesto_d($vinti_command, 'vinti_command');
  // sesto_d((string) $vinti_command, '(string) vinti_command');
  // sesto_d($vinti_client, 'vinti_client');
  $vinti_result = vinti_exec($vinti_client, $vinti_command);
  // sesto_d($vinti_result, 'vinti_result');

  $api_response = new dmpsee_api_response();
  if ($vinti_result->code === 200) {
    $api_response->code = 201;
    $api_response->message = 'Created';
  }
  /* response */
  foreach (sesto_http_header_json() as $header) {
    header($header);
  }
  echo json_encode($api_response, JSON_FORCE_OBJECT);
}
