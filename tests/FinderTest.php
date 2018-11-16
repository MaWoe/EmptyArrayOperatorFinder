<?php

namespace MaWoe\Test\EmptyArrayOperatorFinder;

use MaWoe\EmptyArrayOperatorFinder\Finder;
use PHPUnit\Framework\TestCase;

class FinderTest extends TestCase
{
    public function testGetMatches()
    {
        $finder = new Finder();
        $matches = $finder->getMatches(file_get_contents(__DIR__ . '/testFile.php'));

        $this->assertSame(
            [
                4,
                11,
                16,
                21,
                22,
                23,
            ],
            $matches
        );
    }
}