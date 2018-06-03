<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Abstracts;

use EoneoPay\Utils\Str;

abstract class AbstractDataTransferObject
{
    /**
     * AbstractDataTransferObject constructor.
     *
     * @param array|null $data
     */
    public function __construct(?array $data = null)
    {
        if ($data === null) {
            return;
        }

        $str = new Str();

        foreach ($data as $property => $value) {
            $property = $str->camel($property);

            if (\property_exists($this, $property) === false) {
                continue;
            }

            $this->{$property} = $value;
        }
    }
}
