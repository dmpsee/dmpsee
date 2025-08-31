<?php

/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

class sesto_xml_simple extends SimpleXMLElement
{

  public function add_cdata(string $cdata_text): void
  {
    $node = dom_import_simplexml($this);
    $no = $node->ownerDocument;
    $node->appendChild($no->createCDATASection($cdata_text));
  }

}
