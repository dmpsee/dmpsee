<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_html_element(string $tag, array $attribs = [], string $content = ''): array
{
  return [
    'tag' => $tag,
    'attribs' => $attribs,
    'content' => $content];
}
