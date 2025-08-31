<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_ob_include(string $path): string
{
  ob_start();
  include $path;
  return ob_get_clean() ?: '';
}
