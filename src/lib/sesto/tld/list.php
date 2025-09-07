<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

function sesto_tld_list(): array
{
  return array_diff(scandir(__DIR__ . '/data'), ['..', '.']);
}
