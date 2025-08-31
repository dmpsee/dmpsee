<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/html/void.php';
require_once SESTO_DIR . '/html/attribs.php';

class sesto_html_element
{
  public string $tag;
  public array $attribs;
  public string $content;

  public function __construct(string $tag = '', array $attribs = [], string $content = '') {
    $this->tag = $tag;
    $this->attribs = $attribs;
    $this->content = $content;
  }

  public function __toString(): string {
    $html = '';
    $this->tag = strtolower($this->tag);
    $html = '<' . $this->tag . ' ' . sesto_html_attribs($this->attribs);
    if (isset(sesto_html_void()[$this->tag])) {
      $html .= ' />';
    } else {
      $html .= '>' . ($this->content) . '</' . $this->tag . '>';
    }
    return $html;
  }
}
