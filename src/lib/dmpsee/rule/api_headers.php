<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

function dmpsee_rule_api_headers(): bool
{
  $client_api_id = $_SERVER['HTTP_X_API_ID'] ?? '';
  $client_api_key = $_SERVER['HTTP_X_API_KEY'] ?? '';

  return $client_api_id === '' && $client_api_key === '');
}
