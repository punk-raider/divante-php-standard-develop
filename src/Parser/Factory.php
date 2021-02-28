<?php

declare(strict_types=1);

namespace App\Parser;

use App\Exception\ParserNotFoundException;

class Factory implements FactoryInterface
{
    /** @var mixed[]  */
    private array $registeredParsers;

    /**
     * @param mixed[] $registeredParsers
     */
    public function __construct(array $registeredParsers)
    {
        $this->registeredParsers = $registeredParsers;
    }

    public function getParser(string $type): ParserInterface
    {
        $parserClassName = $this->registeredParsers[$type];
        if (!is_string($parserClassName)) {
            throw new ParserNotFoundException($type);
        }

        return new $parserClassName();
    }
}
