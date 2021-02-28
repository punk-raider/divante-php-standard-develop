<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class GetProductsEvent extends Event
{
    public const NAME = 'app.get_product';

    protected array $products;

    protected string $supplierName;

    public function __construct(array $products, string $supplierName)
    {
        $this->products = $products;
        $this->supplierName = $supplierName;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }
}
