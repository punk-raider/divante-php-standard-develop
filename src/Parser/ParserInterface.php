<?php

namespace App\Parser;

use App\Exception\InvalidParserException;

interface ParserInterface
{
    /**
     * @param string $content
     * @return mixed[]
     * @throws InvalidParserException
     */
    public function parse(string $content): array;

    public static function getType(): string;
}
