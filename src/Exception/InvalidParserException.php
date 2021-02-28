<?php

namespace App\Exception;

class InvalidParserException extends \DomainException
{
    public function __construct(string $type)
    {
        parent::__construct('Invalid parser: ' . $type);
    }
}
