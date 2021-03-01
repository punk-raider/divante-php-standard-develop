<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Exception\BadResponseException;
use App\Exception\InvalidParserException;

class Supplier2 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier2';
    }
    public static function getResponseType(): string
    {
        return 'xml';
    }

    /**
     * @return mixed[]
     * @throws InvalidParserException
     */
    protected function parseResponse(): array
    {
        $response = $this->getResponse();
        if (!is_string($response)) {
            throw new BadResponseException(self::getName());
        }
        $parsedResponse = $this->parser->parse($response);

        return $parsedResponse['item'];
    }

    protected function getResponse(): string|bool
    {
        return file_get_contents('http://nginx/suppliers/supplier2.xml');
    }
}
