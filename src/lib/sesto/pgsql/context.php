<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class sesto_pgsql_context
{
  public false|pgsql\connection $connection;
  public bool $profile = false;
  public string $error = '';
}
