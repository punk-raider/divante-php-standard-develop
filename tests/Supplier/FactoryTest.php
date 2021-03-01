<?php

declare(strict_types=1);

namespace App\Tests\Supplier;

use App\Exception\SupplierNotFoundException;
use App\Parser\FactoryInterface;
use App\Supplier\Factory;
use App\Supplier\Supplier1;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class FactoryTest extends TestCase
{

    public function testGetSupplierThrowsExceptionWhenSupplierNotFound(): void
    {
        $factory = new Factory(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FactoryInterface::class),
            []
        );

        $this->expectException(SupplierNotFoundException::class);

        $factory->getSupplier('supplier');
    }

    public function testGetSupplier(): void
    {
        $factory = new Factory(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FactoryInterface::class),
            ['supplier' => 'App\Supplier\Supplier1']
        );

        $this->assertInstanceOf(Supplier1::class, $factory->getSupplier('supplier'));
    }
}
