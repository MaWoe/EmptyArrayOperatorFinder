<?php

define('SF_ROOT_DIR', realpath(__DIR__ . '/../private'));
require_once __DIR__ . '/EmptyArrayOperatorFinder.php';
require_once __DIR__ . '/Token.php';
require_once __DIR__ . '/PathIterator.php';

$pathIterator = new PathIterator();
$pathIterator->iteratePaths([SF_ROOT_DIR]);
//$pathIterator->iteratePaths([__DIR__]);
