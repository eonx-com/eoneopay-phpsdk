<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces\Factories;

use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;

interface EoneoPayApiManagerFactoryInterface
{
    /**
     * Create EoneoPay api manager instance.
     *
     * @param string $baseUri Base uri used by api manager
     *
     * @return \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    public function create(string $baseUri): EoneoPayApiManagerInterface;
}
