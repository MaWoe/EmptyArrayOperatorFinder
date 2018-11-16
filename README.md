# EmptyArrayOperatorFinder
Finds occurrences of empty index operator  (`[]`).
This is for migrating PHP code to PHP >= 7.1 since it is not allowed to use empty index operator
on strings now:

http://php.net/manual/en/migration71.incompatible.php#migration71.incompatible.empty-string-index-operator

## Usage

```bash
bin/scan.php <path to scan>
```