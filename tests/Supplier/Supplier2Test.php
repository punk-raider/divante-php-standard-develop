<?php

declare(strict_types=1);

namespace App\Tests\Supplier;

use App\Parser\ParserInterface;
use App\Supplier\Supplier2;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class Supplier2Test extends TestCase
{

    public function testGetName(): void
    {
        $this->assertSame('supplier2', Supplier2::getName());
    }

    public function testGetResponseType(): void
    {
        $this->assertSame('xml', Supplier2::getResponseType());
    }

    public function testGetProducts(): void
    {
        $parserMock = $this->createMock(ParserInterface::class);
        $products = ['item' => []];
        $parserMock->method('parse')->willReturn($products);

        $supplier = new Supplier2(
            $parserMock,
            $this->createMock(EventDispatcherInterface::class)
        );

        $this->assertSame($products['item'], $supplier->getProducts());
    }
}
