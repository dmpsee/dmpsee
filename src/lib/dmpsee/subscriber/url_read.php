<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once VINTI_DIR . '/client.php';
require_once VINTI_DIR . '/exec.php';

function dmpseee_subscriber_url_read(vinti_client $client, string $subscriber_id): string
{
  $result = vinti_exec($client, vinti_fi_get('subscriber/' . $subscriber_id, 'url'));
  $subscriber = json_decode($result->message, true);
  return $subscriber['url'] ?? '';
}