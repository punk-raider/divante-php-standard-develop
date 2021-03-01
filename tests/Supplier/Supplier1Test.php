<?php

declare(strict_types=1);

namespace App\Tests\Supplier;

use App\Parser\ParserInterface;
use App\Supplier\Supplier1;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class Supplier1Test extends TestCase
{

    public function testGetName(): void
    {
        $this->assertSame('supplier1', Supplier1::getName());
    }

    public function testGetResponseType(): void
    {
        $this->assertSame('xml', Supplier1::getResponseType());
    }

    public function testGetProducts(): void
    {
        $parserMock = $this->createMock(ParserInterface::class);
        $products = ['product' => []];
        $parserMock->method('parse')->willReturn($products);

        $supplier = new Supplier1(
            $parserMock,
            $this->createMock(EventDispatcherInterface::class)
        );

        $this->assertSame($products['product'], $supplier->getProducts());
    }
}
