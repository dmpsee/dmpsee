<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

const SESTO_DIR = __DIR__;
const SESTO_VERSION = 'v.12025.1';
const SESTO_CODENAME = 'White Ash';

defined('SESTO_MEMORY_START') || define('SESTO_MEMORY_START', memory_get_usage(true));
defined('SESTO_MICROTIME_START') || define('SESTO_MICROTIME_START', microtime(true));
