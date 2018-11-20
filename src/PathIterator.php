<?php

namespace MaWoe\EmptyArrayOperatorFinder;

use CallbackFilterIterator;
use PhpParser\Error;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use SplFileInfo;

class PathIterator
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function iteratePaths(array $paths)
    {
        foreach ($paths as $path) {
            if (!is_dir($path)) {
                throw new RuntimeException('Given path "' . $path . '" is not a directory');
            }
            /** @var SplFileInfo $fileInfo */
            foreach ($this->createIteratorForPhpFiles($path) as $fileInfo) {
                $filePath = $fileInfo->getPathname();
                try {
                    $matches = $this->finder->getMatches(file_get_contents($filePath));
                    foreach ($matches as $line) {
                        echo $filePath, ':', $line, PHP_EOL;
                    }
                } catch (Error $e) {
                    echo $filePath, ' - ERROR: ', $e->getMessage(), PHP_EOL;
                }
            }
        }
    }

    private function createIteratorForPhpFiles(string $path): CallbackFilterIterator
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        return new CallbackFilterIterator(
            $iterator,
            function (SplFileInfo $currentItem) {
                return preg_match('/\.(php|yml|tpl)$/', $currentItem->getFilename()) > 0;
            }
        );
    }
}