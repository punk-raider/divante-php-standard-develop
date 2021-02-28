<?php

declare(strict_types=1);

namespace App\Exception;

class BadResponseException extends \DomainException
{
    public function __construct(string $supplierName)
    {
        parent::__construct('Bad response from ' . $supplierName);
    }
}
