<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_object_init(object $object, array $data): mixed {
  foreach ($data as $key => $value) {
    if (property_exists($object, $key)) {
      $object->$key = $value;
    }
  }
  return $object;
}
