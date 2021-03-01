<?php

declare(strict_types=1);

namespace App\Tests\Parser;

use App\Exception\InvalidParserException;
use App\Parser\XmlParser;
use PHPUnit\Framework\TestCase;

class XmlParserTest extends TestCase
{
    public function testParse(): void
    {
        $parser = new XmlParser();

        $this->assertSame(
            ['test_parent' => [0 => ['test_key' => 'test_value']]],
            $parser->parse('<xml><test_parent><test_key>test_value</test_key></test_parent></xml>')
        );
    }

    public function testGetTypeThrowsExceptionWhenParseError(): void
    {
        $parser = new XmlParser();

        $this->expectException(InvalidParserException::class);

        $parser->parse('');
    }

    public function testGetType(): void
    {
        $this->assertSame('xml', XmlParser::getType());
    }
}
