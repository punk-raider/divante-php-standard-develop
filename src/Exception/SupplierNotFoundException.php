<?php

declare(strict_types=1);

namespace App\Exception;

class SupplierNotFoundException extends \UnexpectedValueException
{
    public function __construct(string $supplierName)
    {
        parent::__construct('Supplier: ' . $supplierName . 'not found!');
    }
}
