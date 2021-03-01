<?php

declare(strict_types=1);

namespace App\Tests\Parser;

use App\Exception\InvalidParserException;
use App\Parser\JsonParser;
use PHPUnit\Framework\TestCase;

class JsonParserTest extends TestCase
{

    public function testParse(): void
    {
        $parser = new JsonParser();

        $this->assertSame(['test_key' => 'test_value'], $parser->parse('{"test_key": "test_value"}'));
    }

    public function testGetTypeThrowsExceptionWhenParseError(): void
    {
        $parser = new JsonParser();

        $this->expectException(InvalidParserException::class);

        $parser->parse('');
    }

    public function testGetType(): void
    {
        $this->assertSame('json', JsonParser::getType());
    }
}
