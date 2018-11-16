#!/usr/bin/env php
<?php

use MaWoe\EmptyArrayOperatorFinder\Finder;
use MaWoe\EmptyArrayOperatorFinder\PathIterator;

require_once __DIR__ . '/../vendor/autoload.php';

$finder = new Finder();
$pathIterator = new PathIterator($finder);
$pathIterator->iteratePaths([$_SERVER['argv'][1]]);