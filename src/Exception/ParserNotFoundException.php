<?php

declare(strict_types=1);

namespace App\Exception;

class ParserNotFoundException extends \InvalidArgumentException
{
    public function __construct(string $type)
    {
        parent::__construct('Parser: ' . $type . 'not found');
    }
}
