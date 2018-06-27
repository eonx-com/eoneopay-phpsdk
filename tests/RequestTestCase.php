<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Client;
use EoneoPay\PhpSdk\ClientConfiguration;

abstract class RequestTestCase extends TestCase
{
    /**
     * @var \EoneoPay\PhpSdk\Client
     */
    protected $client;

    /**
     * Instantiate attribute.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client(new ClientConfiguration('4c92a1f9c8981252', 'http://payments.eoneopay.box'));
    }
}
