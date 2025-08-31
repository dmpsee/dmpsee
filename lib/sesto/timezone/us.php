<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_timezone_us(string $state = null): string
{
  $timezones = [
    'AL' => 'America/Chicago',
    'AZ' => 'America/Denver',
    'CA' => 'America/Los_Angeles',
    'CO' => 'America/Denver',
    'DE' => 'America/New_York',
    'FL' => 'America/New_York',
    'GA' => 'America/New_York',
    'ID' => 'America/Denver',
    'IL' => 'America/Chicago',
    'IN' => 'America/New_York',
    'IA' => 'America/Chicago',
    'KS' => 'America/Chicago',
    'KY' => 'America/New_York',
    'LA' => 'America/Chicago',
    'MD' => 'America/New_York',
    'MA' => 'America/New_York',
    'MI' => 'America/New_York',
    'MN' => 'America/Chicago',
    'MS' => 'America/Chicago',
    'MO' => 'America/Chicago',
    'NE' => 'America/Chicago',
    'NV' => 'America/Los_Angeles',
    'NH' => 'America/New_York',
    'NJ' => 'America/New_York',
    'NM' => 'America/Denver',
    'ND' => 'America/Chicago',
    'OH' => 'America/New_York',
    'OK' => 'America/Chicago',
    'OR' => 'America/Los_Angeles',
    'RI' => 'America/New_York',
    'SC' => 'America/New_York',
    'TN' => 'America/New_York',
    'TX' => 'America/Chicago',
    'UT' => 'America/Denver',
    'WY' => 'America/Denver',
  ];
  return (null === $state) ? $timezones : ($timezones[strtoupper($state)] ?? '');
}
