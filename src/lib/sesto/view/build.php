<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/view/render.php';

function sesto_view_build(array $views, string $name, object|array $data = [], bool $strict = true): string
{
  ob_start();
  sesto_view_render($views, $name, $data, $strict);
  $out = ob_get_contents() ?: '';
  ob_end_clean();
  return $out;
}
