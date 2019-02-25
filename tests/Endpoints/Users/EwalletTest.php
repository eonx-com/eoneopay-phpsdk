<?php
/**
 * Created by PhpStorm.
 * User: Codeint
 * Date: 25/02/2019
 * Time: 13:58
 */

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Users\Ewallet;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\Ewallet
 */
class EwalletTest extends TestCase
{
    /**
     * Test to check if Uri has been entered
     *
     * @return void
     */
    public function testUriIsCreated(): void
    {
        $ewallet = new Ewallet();
        self::assertCount(1, $ewallet->uris());
    }
}
