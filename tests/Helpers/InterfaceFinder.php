<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Helpers;

use ErrorException;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;

class InterfaceFinder implements InterfaceFinderInterface
{
    /**
     * Base path of the application.
     *
     * @var string
     */
    public $basePath;

    /**
     * InterfaceFinder constructor.
     *
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * {@inheritdoc}
     */
    public function find(string $interface, ?string $directory = null, ?string $namespace = null): array
    {
        $path = $this->buildPath($directory);

        // Create recursive iterator
        $iterator = new RegexIterator(
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::LEAVES_ONLY
            ),
            '/^.+.php$/i',
            RecursiveRegexIterator::GET_MATCH
        );

        // Load each file
        foreach ($iterator as $file) {
            // If file[0] is null, skip this file
            if (isset($file[0]) === false) {
                // The iterator should always return a filename, this is only for safety
                // @codeCoverageIgnoreStart
                continue;
                // @codeCoverageIgnoreEnd
            }

            // Only include file if it exists
            try {
                $this->requireFile($file[0]);
                // @codeCoverageIgnoreStart
            } /** @noinspection BadExceptionsProcessingInspection */ catch (ErrorException $exception) {
                // Exception is intentionally ignored, will only be thrown by routing files which require
                // the router to be defined as $router prior to being loaded, we can't guarantee this will happen
            }
            // @codeCoverageIgnoreEnd
        }

        // Filter classes down to classes which implement the required interface
        $classes = [];
        foreach (\get_declared_classes() as $className) {
            // check that class exists in the given namespace
            if (\is_string($namespace) === true && \strncmp($className, $namespace, \mb_strlen($namespace)) !== 0) {
                continue;
            }

            // check that declared class implements the interface to check
            if (\in_array($interface, \class_implements($className), true) === true) {
                $classes[] = $className;
            }
        }

        return $classes;
    }

    /**
     * Build path to where the search needs to be performed.
     *
     * @param string|null $path
     *
     * @return string
     */
    private function buildPath(?string $path = null): string
    {
        return \sprintf('%s/%s', $this->basePath, $path ?? '');
    }

    /**
     * @noinspection PhpDocRedundantThrowsInspection Exception is thrown if there is an error in the required file
     *
     * Require a file
     *
     * @param string $filename The file to require
     *
     * @return void
     *
     * @throws \ErrorException If the file contains an error, such as undefined variable
     */
    private function requireFile(string $filename): void
    {
        /** @noinspection PhpIncludeInspection Must require files dynamically */
        require_once $filename;
    }
}
