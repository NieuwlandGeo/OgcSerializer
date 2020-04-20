<?php

declare(strict_types=1);

namespace Nieuwland\OgcSerializer\Generic\Transformer;

use DOMDocument;
use DOMNodeList;
use DOMXPath;
use Nieuwland\OgcSerializer\Generic\LayerCapabilities;
use Nieuwland\OgcSerializer\Generic\ServiceCapabilities;

class TMSTransformer implements TransformerInterface
{
    /**
     * {@inheritdoc}
     *
     * @param string $data xml string
     */
    public function transform($data): ServiceCapabilities
    {
        $doc = new DOMDocument();
        $doc->loadXML($data);
        $xPath = new DOMXPath($doc);
        $title = $this->getText($xPath->query('//Title'));

        $layer = new LayerCapabilities(
            $title,
            [$this->getText($xPath->query('//SRS'))],
            $title,
            null,
            [$this->getAttribute($xPath->query('//TileFormat'), 'extension')]
        );

        return new ServiceCapabilities(
            $title,
            [$layer],
            ['1.0.0']
        );
    }

    /**
     * Get text of first element in list.
     */
    private function getText(DOMNodeList $list): ?string
    {
        if (0 === $list->length) {
            return null;
        }

        return $list->item(0)->textContent;
    }

    /**
     * Get attribute of first element.
     */
    private function getAttribute(DOMNodeList $list, string $attr): ?string
    {
        if (0 === $list->length) {
            return null;
        }

        return $list->item(0)->attributes->getNamedItem($attr)->textContent;
    }
}
