<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors
// Note this function has been inspired from Zend Framework 1 (Zend_Filter_StringTrim)

declare(strict_types=1);

function sesto_string_trim(string $value, string $charlist = '\\\\s'): string
{
  $chars = preg_replace(
    ['/[\^\-\]\\\]/S', '/\\\{4}/S', '/\//'],
    ['\\\\\\0', '\\', '\/'],
    $charlist
  );
  $pattern = '/^[' . $chars . ']+|[' . $chars . ']+$/usSD';
  return preg_replace($pattern, '', $value);
}
