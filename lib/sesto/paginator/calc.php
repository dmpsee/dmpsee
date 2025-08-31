<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function sesto_paginator_calc(sesto_paginator $paginator): void
{
  if ($paginator->items_per_page > 0) {
    if ($paginator->current_page < 1) {
      $paginator->current_page = 1;
    }
    $paginator->num_pages = (int) ceil($paginator->num_rows / $paginator->items_per_page);
    if ($paginator->current_page > $paginator->num_pages) {
      $paginator->current_page = $paginator->num_pages - 1;
    }
    $paginator->offset = ($paginator->current_page - 1) * $paginator->items_per_page;
  }
}