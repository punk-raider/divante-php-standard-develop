<?php

namespace App\Supplier;

use App\Exception\SupplierNotFoundException;
use App\Parser\FactoryInterface as ParserFactoryInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class Factory implements FactoryInterface
{
    private ParserFactoryInterface $parserFactory;
    /** @var string[] */
    private array $registeredSuppliers;
    private EventDispatcherInterface $eventDispatcher;

    /**
     * @param string[] $registeredSuppliers
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        ParserFactoryInterface $parserFactory,
        array $registeredSuppliers
    ) {
        $this->parserFactory = $parserFactory;
        $this->eventDispatcher = $eventDispatcher;
        $this->registeredSuppliers = $registeredSuppliers;
    }

    public function getSupplier($supplierName): SupplierInterface
    {
        $supplierClassName = $this->registeredSuppliers[$supplierName];
        if (!is_string($supplierClassName)) {
            throw new SupplierNotFoundException($supplierName);
        }
        $responseType = $supplierClassName::getResponseType();
        $parser = $this->parserFactory->getParser($responseType);

        return new $supplierClassName($parser, $this->eventDispatcher);
    }
}
