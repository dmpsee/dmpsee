<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types = 1);

function sesto_get_type($expression): string
{
  if (is_resource($expression)) {
    $result = get_resource_type($expression);
  } else if (is_object($expression)) {
    $result = get_class($expression);
  } else {
    $result = gettype($expression);
  }
  return $result;
}

