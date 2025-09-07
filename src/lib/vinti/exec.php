<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once 'client.php';
require_once 'command.php';
require_once 'result.php';

function vinti_exec(vinti_client $client, vinti_command $command): vinti_result
{
  $result = new vinti_result();

  $ch = curl_init($client->endpoint);
  curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => (string) $command,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD        => "$client->username:$client->password",
  ]);

  $response = curl_exec($ch);
  if (curl_errno($ch)) {
    $result->error = curl_error($ch);
  } else {
    // $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $decoded = json_decode($response, true);
    if (is_array($decoded)) {
      $result->code = $decoded['code'] ?? 0;
      $result->message = $decoded['message'] ?? '';
      $result->files = $decoded['files'] ?? [];
    }
  }
  curl_close($ch);

  return $result;
}
