<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class Repository
{
    /**
     * Entity repository class.
     *
     * @var string
     */
    public $repositoryClass;
}
