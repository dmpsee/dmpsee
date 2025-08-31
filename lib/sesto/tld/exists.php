<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_tld_exists(string $tld): bool
{
  $tld = str_replace(chr(0), '', $tld); /* filter null byte */
  if ('' === $tld) {
    $result = false;
  } else {
    $result = file_exists(__DIR__ . '/data/' . $tld);
  }
  return $result;
}
