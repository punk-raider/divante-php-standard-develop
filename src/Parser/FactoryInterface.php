<?php

namespace App\Parser;

interface FactoryInterface
{
    /**
     * @param string $type
     * @return ParserInterface
     * @throws \InvalidArgumentException
     */
    public function getParser(string $type): ParserInterface;
}
