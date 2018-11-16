<?php

/**
 * This is no match: $variable[] = 123;
 */
$a = [];
$a[] = 10;
$a[1] = 10;
$a[ 2 ] = 10;

$a[11][] = 10;
$a[11][1] = 10;
$a[11][ 2 ] = 10;

$s = new stdClass();

// $variable[] = 123;
/* $variable[] = 123 */
$someVariable = '$variable[] = 123';
$someVariable = '[] = 123';

$s->abc = [];
$s->abc[] = 10;
$s->abc[1] = 10;
$s->abc[ 2 ] = 10;

$s->a->b = [];
$s->a->b[] = 10;
$s->a->b[1] = 10;
$s->a->b[ 2 ] = 10;

SomeClass::$variable = [];
SomeClass::$variable[] = 10;
SomeClass::$variable [] = 10;
SomeClass::$variable [ ] = 10;
SomeClass::$variable[1] = 10;
SomeClass::$variable[ 2 ] = 10;