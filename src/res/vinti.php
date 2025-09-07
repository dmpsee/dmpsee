<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/config/php.php';
require_once SESTO_SYS_LIB_DIR . '/vinti/client.php';

$config = sesto_config_php(SESTO_SYS_CONF_DIR . '/vinti.php');

$client = new vinti_client();
$client->username = $config['username'] ?? '';
$client->password = $config['password'] ?? '';
$client->endpoint = $config['endpoint'] ?? '';
return $client;