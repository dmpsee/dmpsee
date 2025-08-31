<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/url/url.php';

class dmpsee_api_app
{
  public array $config = [];
  public array $args = [];
  public sesto_url $url;
  public string $controller_dir = '';
}
