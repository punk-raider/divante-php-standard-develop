<?php

namespace App\Supplier;

use App\Event\GetProductsEvent;
use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

abstract class SupplierAbstract implements SupplierInterface
{
    protected ParserInterface $parser;
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct(ParserInterface $parser, EventDispatcherInterface $eventDispatcher)
    {
        $this->parser = $parser;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return mixed[]
     * @throws InvalidParserException
     * @throws \Exception
     */
    abstract protected function parseResponse(): array;

    /**
     * @return mixed[]
     */
    public function getProducts(): array
    {
        $products = $this->parseResponse();
        $event = new GetProductsEvent($products, static::getName());

        $this->eventDispatcher->dispatch($event, GetProductsEvent::NAME);

        return $products;
    }
}
