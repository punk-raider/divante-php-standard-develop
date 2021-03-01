<?php

declare(strict_types=1);

namespace App\Tests\Parser;

use App\Exception\ParserNotFoundException;
use App\Parser\Factory;
use App\Parser\JsonParser;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    public function testGetParserThrowsExceptionWhenParserNotFound(): void
    {
        $factory = new Factory([]);

        $this->expectException(ParserNotFoundException::class);

        $factory->getParser('txt');
    }

    public function testGetParser(): void
    {
        $factory = new Factory(['json' => 'App\Parser\JsonParser']);

        $this->assertInstanceOf(JsonParser::class, $factory->getParser('json'));
    }
}
