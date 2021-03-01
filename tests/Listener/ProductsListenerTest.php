<?php

declare(strict_types=1);

namespace App\Tests\Listener;

use App\Event\GetProductsEvent;
use App\Listener\ProductsListener;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ProductsListenerTest extends TestCase
{

    public function testLogProducts(): void
    {
        $eventMock = $this->createMock(GetProductsEvent::class);
        $eventMock->method('getProducts')->willReturn([0 => ['test_key' => 'test_value']]);
        $eventMock->method('getSupplierName')->willReturn('test_supplier');
        $loggerMock = $this->createMock(LoggerInterface::class);

        $listener = new ProductsListener('', $loggerMock);

        $loggerMock
            ->expects($this->once())
            ->method('info')
            ->with('Product added: test_value', ['supplier' => 'test_supplier']);

        $listener->logProducts($eventMock);
    }
}
