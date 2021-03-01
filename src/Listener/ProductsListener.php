<?php

namespace App\Listener;

use App\Event\GetProductsEvent;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Symfony\Contracts\EventDispatcher\Event;

class ProductsListener
{
    private LoggerInterface $logger;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(string $logFilePath, LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new Logger(
            'suppliers_logger',
            [new StreamHandler($logFilePath, Logger::INFO, false)]
        );
    }

    public function logProducts(Event $event): bool
    {
        if ($event instanceof GetProductsEvent) {
            foreach ($event->getProducts() as $product) {
                $productKeys = array_keys($product);
                $this->logger->info(
                    'Product added: ' . $product[$productKeys[0]],
                    ['supplier' => $event->getSupplierName()]
                );
            }
        }

        return true;
    }
}
