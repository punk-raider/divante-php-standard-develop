<?php

declare(strict_types=1);

namespace App\Parser;

use App\Exception\InvalidParserException;

class XmlParser implements ParserInterface
{
    public static function getType(): string
    {
        return 'xml';
    }

    /**
     * @return mixed[]
     */
    public function parse(string $content): array
    {
        try {
            $parsedXml = new \SimpleXMLElement($content);
        } catch (\Exception $e) {
            throw new InvalidParserException(self::getType());
        }

        return $this->parseNode($parsedXml);
    }

    /**
     * @return mixed[]
     */
    private function parseNode(\SimpleXMLElement $node): array
    {
        $parsedNodes = [];
        foreach ($node->children() as $childNode) {
            if ($childNode->count() == 0) {
                $parsedNodes[$childNode->getName()] = (string)$childNode;
            } else {
                $parsedNodes[$childNode->getName()][] = $this->parseNode($childNode);
            }
        }

        return $parsedNodes;
    }
}
