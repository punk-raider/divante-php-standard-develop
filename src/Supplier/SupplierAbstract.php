<?php

namespace App\Supplier;

use App\Event\GetProductsEvent;
use App\Event\IntegrationEvents;
use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class SupplierAbstract implements SupplierInterface
{
    protected ParserInterface $parser;
    protected EventDispatcher$eventDispatcher;

    public function __construct(ParserInterface $parser, EventDispatcher $eventDispatcher)
    {
        $this->parser = $parser;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return array
     * @throws InvalidParserException
     * @throws \Exception
     */
    abstract protected function parseResponse(): array;

    public function getProducts(): array
    {
        //todo Get the products
    }
}
