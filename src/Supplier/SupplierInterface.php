<?php

namespace App\Supplier;

use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

interface SupplierInterface
{
    public function __construct(ParserInterface $parser, EventDispatcher $eventDispatcher);

    /**
     * @return array
     * @throws InvalidParserException
     */
    public function getProducts(): array;

    public static function getName(): string;

    public static function getResponseType(): string;
}
