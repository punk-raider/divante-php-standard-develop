<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class GetProductsEvent extends Event
{
    public const NAME = 'supplier.getProducts';

    /** @var mixed[]  */
    private array $products;

    private string $supplierName;

    /**
     * @param mixed[] $products
     */
    public function __construct(array $products, string $supplierName)
    {
        $this->products = $products;
        $this->supplierName = $supplierName;
    }

    /**
     * @return mixed[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }
}
