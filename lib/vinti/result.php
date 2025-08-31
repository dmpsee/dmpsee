<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class vinti_result
{
  public string $error = '';
  public int $code = 0;
  public string $message = '';
  public array $files = [];
}
