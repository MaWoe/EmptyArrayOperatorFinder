# EmptyArrayOperatorFinder
This library is being developed to find occurrences of empty index operator  (`[]`) on strings.
This is for migrating PHP < 7.1 code to PHP >= 7.1 since it is not allowed to use empty index operator
on strings now:

http://php.net/manual/en/migration71.incompatible.php#migration71.incompatible.empty-string-index-operator

In PHP 5.6 the type of a variable can not always be determined reliably. Thus the finder first focuses
on finding ALL empty index operator occurrences in code, then tries to determine the type of the variable
it operates on right before the operation takes place (yes, it might change several times).

Todos
-----

Classify operator matches by the type of variable, they operate on.
The type can be one of the following:

- unknown
- array
- string
- others

The classification is a means to help identify operator usage on strings.