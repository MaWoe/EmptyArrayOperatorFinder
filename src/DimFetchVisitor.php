<?php

namespace MaWoe\EmptyArrayOperatorFinder;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class DimFetchVisitor extends NodeVisitorAbstract
{
    private $matches = [];

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Expr\ArrayDimFetch) {
            if ($node->dim === null) {
                $this->matches[] = $node->getLine();
            }
        }
    }

    /**
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }
}