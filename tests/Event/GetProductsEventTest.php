<?php

declare(strict_types=1);

namespace App\Tests\Event;

use App\Event\GetProductsEvent;
use PHPUnit\Framework\TestCase;

class GetProductsEventTest extends TestCase
{
    public function testGetProducts(): void
    {
        $products = [
            'test' => 'test',
        ];

        $event = new GetProductsEvent($products, '');

        $this->assertSame($products, $event->getProducts());
    }

    public function testGetSupplierName(): void
    {
        $event = new GetProductsEvent([], 'test');

        $this->assertSame('test', $event->getSupplierName());
    }
}
