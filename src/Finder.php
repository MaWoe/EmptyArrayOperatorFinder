<?php

namespace MaWoe\EmptyArrayOperatorFinder;

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

class Finder
{
    public function getMatches(string $fileContents): array
    {
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $ast = $parser->parse($fileContents);
        $traverser = new NodeTraverser();
        $visitor = new DimFetchVisitor();
        $traverser->addVisitor($visitor);
        $traverser->traverse($ast);
        return $visitor->getMatches();
    }
}