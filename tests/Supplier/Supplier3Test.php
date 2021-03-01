<?php

declare(strict_types=1);

namespace App\Tests\Supplier;

use App\Parser\ParserInterface;
use App\Supplier\Supplier3;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class Supplier3Test extends TestCase
{

    public function testGetName(): void
    {
        $this->assertSame('supplier3', Supplier3::getName());
    }

    public function testGetResponseType(): void
    {
        $this->assertSame('json', Supplier3::getResponseType());
    }

    public function testGetProducts(): void
    {
        $parserMock = $this->createMock(ParserInterface::class);
        $products = ['list' => []];
        $parserMock->method('parse')->willReturn($products);

        $supplier = new Supplier3(
            $parserMock,
            $this->createMock(EventDispatcherInterface::class)
        );

        $this->assertSame($products['list'], $supplier->getProducts());
    }
}
