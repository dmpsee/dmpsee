<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors
// Note this function has been inspired from spaceless.php https://gist.github.com/diasfs/0c7759b1bb40323d2d155b310637a871

declare(strict_types=1);

function sesto_spacetrim(string $value): ?string
{
  $value = preg_replace(
    [
      '/\>[^\S ]+/s', // strip whitespaces after tags, except space
      '/[^\S ]+\</s', // strip whitespaces before tags, except space
      '/(\s)+/s', // shorten multiple whitespace sequences
      '/<!--(.|\s)*?-->/' // Remove HTML comments
    ],
    [
      '>',
      '<',
      '\\1',
      ''
    ],
    $value
  );
  if (is_string($value)) {
    $value = preg_replace('~>\s+<~', '><', $value);
  }

  return $value;
}
