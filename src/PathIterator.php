<?php

class PathIterator
{
    public function iteratePaths(array $paths)
    {
        foreach ($paths as $path) {
            /** @var SplFileInfo $fileInfo */
            foreach ($this->createIteratorForPhpFiles($path) as $fileInfo) {
                $filePath = $fileInfo->getPathname();
                $matches = (new EmptyArrayOperatorFinder($filePath))->getMatches();
                foreach ($matches as $line) {
                    echo $filePath, ':', $line, PHP_EOL;
                }
            }
        }
    }

    /**
     * @param $path
     *
     * @return CallbackFilterIterator
     */
    private function createIteratorForPhpFiles($path)
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        return new CallbackFilterIterator($iterator, function(SplFileInfo $currentItem) {
            return preg_match('/\.(php|yml|tpl)$/', $currentItem->getFilename()) > 0;
        });
    }
}