<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Helpers;

interface InterfaceFinderInterface
{
    /**
     * Find all classes which use a specific interface.
     *
     * @param string $interface The interface to find matching classes for
     * @param string|null $directory Directory to scan
     * @param string|null $namespace Namespace to filter classes with
     *
     * @return string[]
     */
    public function find(string $interface, ?string $directory = null, ?string $namespace = null): array;
}
