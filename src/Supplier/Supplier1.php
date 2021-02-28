<?php

namespace App\Supplier;

class Supplier1 extends SupplierAbstract
{
    public static function getName(): string
    {
        return 'supplier1';
    }

    public static function getResponseType(): string
    {
        return 'xml';
    }

    protected function parseResponse(): array
    {
        //todo Parse the response
    }

    protected function getResponse(): string|bool
    {
        return file_get_contents('http://localhost/suppliers/supplier1.xml');
    }
}
