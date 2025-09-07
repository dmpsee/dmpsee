<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_datetime_from_format(string $format, string $string, datetimezone $timezone): ?datetime
{
  $date = date_create_from_format($format, $string, $timezone);
  $result = null;
  if (false !== $date) {
    if (date_get_last_errors()['warning_count'] == 0 && date_get_last_errors()['error_count'] == 0) {
      $result = $date;
    }
  }

  return $result;
}
