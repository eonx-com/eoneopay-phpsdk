<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;

abstract class RequestTestCase extends TestCase
{
    /**
     * @var \EoneoPay\PhpSdk\Client $client
     */
    protected $client;

    /**
     * Instantiate attribute.
     *
     * @return void
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client();
    }
}
