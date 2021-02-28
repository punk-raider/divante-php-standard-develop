<?php

namespace App\Supplier;

interface FactoryInterface
{
    /**
     * @param string $supplierName
     * @return SupplierInterface
     * @throws \InvalidArgumentException
     */
    public function getSupplier(string $supplierName): SupplierInterface;
}
