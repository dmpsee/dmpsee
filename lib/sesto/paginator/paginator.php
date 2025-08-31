<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

final class sesto_paginator
{
  public int $items_per_page = 50;
  public int $num_rows = 0;
  public int $num_pages = 0;
  public int $current_page = 0;
  public int $offset = 0;
}