<?php

declare(strict_types=1);

namespace App\Parser;

use App\Exception\InvalidParserException;

class JsonParser implements ParserInterface
{
    public static function getType(): string
    {
        return 'json';
    }

    /**
     * @return mixed[]
     */
    public function parse(string $content): array
    {
        try {
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            throw new InvalidParserException(self::getType());
        }
    }
}
