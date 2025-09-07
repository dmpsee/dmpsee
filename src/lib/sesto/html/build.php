<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/html/void.php';
require_once SESTO_DIR . '/html/attribs.php';

function sesto_html_build(sesto_html_element $element): string
  {
    $html = '';
    $element->tag = strtolower($element->tag);
    $html = '<' . $element->tag . ' ' . sesto_html_attribs($element->attribs);
    if (isset(sesto_html_void()[$element->tag])) {
      $html .= ' />';
    } else {
      $html .= '>' . ($element->content) . '</' . $element->tag . '>';
    }
    return $html;
  }