<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once VINTI_DIR . '/client.php';
require_once VINTI_DIR . '/exec.php';

function dmpseee_event_subscribers(vinti_client $client, string $event_name): array
{
  $result = vinti_exec($client, vinti_fi_lst('event/' . $event_name . '/subscriber'));
  return $result->files;
}
