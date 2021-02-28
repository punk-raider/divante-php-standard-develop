<?php

namespace App\Supplier;

use App\Event\IntegrationEvents;
use App\Listener\ProductsListener;
use App\Parser\FactoryInterface as ParserFactoryInterface;

use Symfony\Component\EventDispatcher\EventDispatcher;

class Factory implements FactoryInterface
{
    const SUPPLIER_1 = 'supplier1';
    const SUPPLIER_2 = 'supplier2';
    const SUPPLIER_3 = 'supplier3';

    protected ParserFactoryInterface $parserFactory;

    public function __construct(ParserFactoryInterface $parserFactory)
    {
        $this->parserFactory = $parserFactory;
    }

    public function getSupplier($supplierName): SupplierInterface
    {
        //todo Get the correct supplier
    }
}
