<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

class dmpsee_api_response
{
  public int $code = 200;
  public string $message = 'ok';
  public array $events = [];
}
