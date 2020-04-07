<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\Amount;
use EoneoPay\PhpSdk\Endpoints\V2\Balance;
use EoneoPay\PhpSdk\Endpoints\V2\Ewallet as BaseEwallet;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\V2\Transaction;
use EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocation;
use EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocations\Record;
use EoneoPay\PhpSdk\Endpoints\V2\User;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Transaction
 */
class TransactionTest extends TransactionTestCase
{
    /**
     * Tests that transaction resonse can be converted back to transaction object.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength) Method is long to fully test.
     */
    public function testTransactionCreationAndResponse(): void
    {
        $jsonResponse = <<<JSON
{
  "action": "transfer",
  "allocation": {
    "amount": "50.00",
    "created_at": "2020-03-30T02:46:30Z",
    "ewallet": {
      "balances": {
        "available": "248.45",
        "balance": "48.45",
        "credit_limit": "200.00"
      },
      "created_at": "2020-03-30T02:46:26Z",
      "currency": "AUD",
      "id": "WHOLESALE",
      "pan": "W...SALE",
      "primary": false,
      "reference": "WHOLESALE",
      "type": "ewallet",
      "updated_at": "2020-03-30T02:46:33Z",
      "user": {
        "created_at": "2020-03-30T02:46:16Z",
        "email": "provider@example.com",
        "metadata": [],
        "name": null,
        "updated_at": "2020-03-30T02:46:26Z"
      }
    },
    "records": [
      {
        "amount": "1.55",
        "created_at": "2020-03-30T02:46:30Z",
        "ewallet": {
          "balances": {
            "available": "201.55",
            "balance": "1.55",
            "credit_limit": "200.00"
          },
          "created_at": "2020-03-30T02:46:26Z",
          "currency": "AUD",
          "id": "PROVIDER2",
          "pan": "P...DER2",
          "primary": false,
          "reference": "PROVIDER2",
          "type": "ewallet",
          "updated_at": "2020-03-30T02:46:33Z",
          "user": {
            "created_at": "2020-03-30T02:46:16Z",
            "email": "provider@example.com",
            "metadata": [],
            "name": null,
            "updated_at": "2020-03-30T02:46:26Z"
          }
        },
        "updated_at": "2020-03-30T02:46:33Z"
      }
    ],
    "updated_at": "2020-03-30T02:46:33Z"
  },
  "amount": {
    "currency": "AUD",
    "payment_fee": "0.00",
    "subtotal": "55.00",
    "total": "55.00"
  },
  "approved": true,
  "created_at": "2020-03-30T02:46:30Z",
  "description": null,
  "finalised": true,
  "finalised_at": "2020-03-30T02:46:33Z",
  "funding_sources": [
    {
      "amount": {
        "currency": "AUD",
        "payment_fee": "0.00",
        "subtotal": "29.00",
        "total": "29.00"
      },
      "balances": {
        "available": "71.00",
        "balance": "-29.00",
        "credit_limit": "100.00"
      },
      "created_at": "2020-03-30T02:46:27Z",
      "currency": "AUD",
      "id": "TRANSACT2",
      "pan": "T...ACT2",
      "primary": false,
      "reference": "TRANSACT2",
      "type": "ewallet",
      "updated_at": "2020-03-30T02:46:32Z",
      "user": {
        "created_at": "2020-03-30T02:46:27Z",
        "email": "transactor@example.com",
        "metadata": [],
        "name": null,
        "updated_at": "2020-03-30T02:46:27Z"
      }
    }
  ],
  "id": "orderId",
  "metadata": [],
  "parents": [
    {
      "action": "transfer",
      "allocation": null,
      "amount": {
        "currency": "AUD",
        "payment_fee": "0.00",
        "subtotal": "29.00",
        "total": "29.00"
      },
      "approved": true,
      "created_at": "2020-03-30T02:46:30Z",
      "description": null,
      "finalised": true,
      "finalised_at": "2020-03-30T02:46:32Z",
      "funding_sources": [],
      "id": "orderId_1",
      "metadata": [],
      "parents": [],
      "payment_destination": {
        "balances": {
          "available": "74.00",
          "balance": "-26.00",
          "credit_limit": "100.00"
        },
        "created_at": "2020-03-30T02:46:27Z",
        "currency": "AUD",
        "id": "TRANSACT",
        "pan": "T...SACT",
        "primary": true,
        "reference": "TRANSACT",
        "type": "ewallet",
        "updated_at": "2020-03-30T02:46:33Z",
        "user": {
          "created_at": "2020-03-30T02:46:27Z",
          "email": "transactor@example.com",
          "metadata": [],
          "name": null,
          "updated_at": "2020-03-30T02:46:27Z"
        }
      },
      "payment_source": {
        "balances": {
          "available": "71.00",
          "balance": "-29.00",
          "credit_limit": "100.00"
        },
        "created_at": "2020-03-30T02:46:27Z",
        "currency": "AUD",
        "id": "TRANSACT2",
        "name": null,
        "pan": "T...ACT2",
        "primary": false,
        "reference": "TRANSACT2",
        "token": null,
        "type": "ewallet",
        "updated_at": "2020-03-30T02:46:32Z",
        "user": {
          "created_at": "2020-03-30T02:46:27Z",
          "email": "transactor@example.com",
          "metadata": [],
          "name": null,
          "updated_at": "2020-03-30T02:46:27Z"
        }
      },
      "recurring_id": null,
      "response": {
        "acquirer_code": "0",
        "acquirer_message": "Approved",
        "gateway_message": null
      },
      "security": null,
      "state": 80,
      "statement_description": "PAYMENT GATEWAY ORDERID_1",
      "status": "completed",
      "transaction_id": "transactionId_1",
      "updated_at": "2020-03-30T02:46:32Z",
      "user": {
        "created_at": "2020-03-30T02:46:27Z",
        "email": "transactor@example.com",
        "metadata": [],
        "name": null,
        "updated_at": "2020-03-30T02:46:27Z"
      }
    }
  ],
  "payment_destination": {
    "balances": {
      "available": "205.00",
      "balance": "5.00",
      "credit_limit": "200.00"
    },
    "created_at": "2020-03-30T02:46:26Z",
    "currency": "AUD",
    "id": "PROVIDER",
    "pan": "P...IDER",
    "primary": true,
    "reference": "PROVIDER",
    "type": "ewallet",
    "updated_at": "2020-03-30T02:46:33Z",
    "user": {
      "created_at": "2020-03-30T02:46:16Z",
      "email": "provider@example.com",
      "metadata": [],
      "name": null,
      "updated_at": "2020-03-30T02:46:26Z"
    }
  },
  "payment_source": {
    "balances": {
      "available": "74.00",
      "balance": "-26.00",
      "credit_limit": "100.00"
    },
    "created_at": "2020-03-30T02:46:27Z",
    "currency": "AUD",
    "id": "TRANSACT",
    "name": null,
    "pan": "T...SACT",
    "primary": true,
    "reference": "TRANSACT",
    "token": null,
    "type": "ewallet",
    "updated_at": "2020-03-30T02:46:33Z",
    "user": {
      "created_at": "2020-03-30T02:46:27Z",
      "email": "transactor@example.com",
      "metadata": [],
      "name": null,
      "updated_at": "2020-03-30T02:46:27Z"
    }
  },
  "recurring_id": null,
  "response": {
    "acquirer_code": "0",
    "acquirer_message": "Approved",
    "gateway_message": null
  },
  "security": null,
  "state": 80,
  "statement_description": "PAYMENT GATEWAY ORDERID",
  "status": "completed",
  "transaction_id": "transactionId",
  "updated_at": "2020-03-30T02:46:33Z",
  "user": {
    "created_at": "2020-03-30T02:46:27Z",
    "email": "transactor@example.com",
    "metadata": [],
    "name": null,
    "updated_at": "2020-03-30T02:46:27Z"
  }
}
JSON;
        $response = $this->createResponse(
            \json_decode($jsonResponse, true, 512, \JSON_THROW_ON_ERROR)
        );

        $request = new Transaction([
            'amount' => [
                'currency' => 'AUD',
                'total' => '55.00'
            ],
            'allocation' => [
                'amount' => '50.00',
                'ewallet' => [
                    'reference' => 'WHOLESALE',
                    'type' => 'ewallet',
                ],
                'records' => [
                    [
                        'amount' => '1.55',
                        'ewallet' => [
                            'reference' => 'PROVIDER2',
                            'type' => 'ewallet'
                        ]
                    ]
                ]
            ],
            'payment_destination' => [
                'reference' => 'PROVIDER',
                'type' => 'ewallet'
            ],
            'payment_sources' => [
                [
                    'amount' => [
                        'currency' => 'AUD',
                        'total' => '26.00',
                    ],
                    'reference' => 'TRANSACT',
                    'type' => 'ewallet'
                ],
                [
                    'amount' => [
                        'currency' => 'AUD',
                        'total' => '29.00',
                    ],
                    'reference' => 'TRANSACT2',
                    'type' => 'ewallet'
                ],
            ]
        ]);

        $expectedParents = [
            new Transaction([
                'action' => 'transfer',
                'allocation' => null,
                'amount' => new Amount([
                    'currency' => 'AUD',
                    'paymentFee' => '0.00',
                    'subtotal' => '29.00',
                    'total' => '29.00',
                ]),
                'approved' => true,
                'createdAt' => '2020-03-30T02:46:30Z',
                'description' => null,
                'finalised' => true,
                'finalisedAt' => '2020-03-30T02:46:32Z',
                'fundingSources' => [],
                'id' => 'orderId_1',
                'metadata' => [],
                'parents' => [],
                'paymentDestination' => new Ewallet([
                    'createdAt' => '2020-03-30T02:46:27Z',
                    'id' => 'TRANSACT',
                    'name' => null,
                    'pan' => 'T...SACT',
                    'token' => null,
                    'type' => 'ewallet',
                    'updatedAt' => '2020-03-30T02:46:33Z',
                    'currency' => 'AUD',
                    'primary' => true,
                    'reference' => 'TRANSACT',
                    'user' => new User([
                        'createdAt' => '2020-03-30T02:46:27Z',
                        'email' => 'transactor@example.com',
                        'id' => null,
                        'updatedAt' => '2020-03-30T02:46:27Z',
                    ])
                ]),
                'paymentSource' => new Ewallet([
                    'createdAt' => '2020-03-30T02:46:27Z',
                    'id' => 'TRANSACT2',
                    'name' => null,
                    'pan' => 'T...ACT2',
                    'token' => null,
                    'type' => 'ewallet',
                    'updatedAt' => '2020-03-30T02:46:32Z',
                    'currency' => 'AUD',
                    'primary' => false,
                    'reference' => 'TRANSACT2',
                    'user' => new User([
                        'createdAt' => '2020-03-30T02:46:27Z',
                        'email' => 'transactor@example.com',
                        'id' => null,
                        'updatedAt' => '2020-03-30T02:46:27Z',
                    ])
                ]),
                'recurringId' => null,
                'response' => [
                    'acquirer_code' => '0',
                    'acquirer_message' => 'Approved',
                    'gateway_message' => null,
                ],
                'security' => null,
                'state' => 80,
                'statementDescription' => 'PAYMENT GATEWAY ORDERID_1',
                'status' => 'completed',
                'transactionId' => 'transactionId_1',
                'updatedAt' => '2020-03-30T02:46:32Z',
                'user' => new User([
                    'createdAt' => '2020-03-30T02:46:27Z',
                    'email' => 'transactor@example.com',
                    'id' => null,
                    'updatedAt' => '2020-03-30T02:46:27Z',
                ])
            ])
        ];
        $expectedFundings = [
            new Ewallet([
                'createdAt' => '2020-03-30T02:46:27Z',
                'id' => 'TRANSACT2',
                'name' => null,
                'pan' => 'T...ACT2',
                'token' => null,
                'type' => 'ewallet',
                'updatedAt' => '2020-03-30T02:46:32Z',
                'currency' => 'AUD',
                'primary' => false,
                'reference' => 'TRANSACT2',
                'user' => new User([
                    'createdAt' => '2020-03-30T02:46:27Z',
                    'email' => 'transactor@example.com',
                    'id' => null,
                    'updatedAt' => '2020-03-30T02:46:27Z',
                ])
            ])
        ];
        $expected = new Transaction([
            'action' => 'transfer',
            'allocation' => new Allocation([
                'amount' => '50.00',
                'ewallet' => new BaseEwallet([
                    'balances' => new Balance([
                        'available' => '248.45',
                        'balance' => '48.45',
                        'creditLimit' => '200.00',
                    ]),
                    'createdAt' => '2020-03-30T02:46:26Z',
                    'currency' => 'AUD',
                    'id' => 'WHOLESALE',
                    'pan' => 'W...SALE',
                    'primary' => false,
                    'reference' => 'WHOLESALE',
                    'type' => 'ewallet',
                    'updatedAt' => '2020-03-30T02:46:33Z',
                    'user' => new User([
                        'createdAt' => '2020-03-30T02:46:16Z',
                        'email' => 'provider@example.com',
                        'id' => null,
                        'updatedAt' => '2020-03-30T02:46:26Z',
                    ])
                ]),
                'records' => [
                    new Record([
                        'amount' => '1.55',
                        'ewallet' => new BaseEwallet([
                            'balances' => new Balance([
                                'available' => '201.55',
                                'balance' => '1.55',
                                'creditLimit' => '200.00',
                            ]),
                            'createdAt' => '2020-03-30T02:46:26Z',
                            'currency' => 'AUD',
                            'id' => 'PROVIDER2',
                            'pan' => 'P...DER2',
                            'primary' => false,
                            'reference' => 'PROVIDER2',
                            'type' => 'ewallet',
                            'updatedAt' => '2020-03-30T02:46:33Z',
                            'user' => new User([
                                'createdAt' => '2020-03-30T02:46:16Z',
                                'email' => 'provider@example.com',
                                'id' => null,
                                'updatedAt' => '2020-03-30T02:46:26Z',
                            ])
                        ])
                    ])
                ]
            ]),
            'amount' => new Amount([
                'currency' => 'AUD',
                'paymentFee' => '0.00',
                'subtotal' => '55.00',
                'total' => '55.00',
            ]),
            'approved' => true,
            'createdAt' => '2020-03-30T02:46:30Z',
            'description' => null,
            'finalised' => true,
            'finalisedAt' => '2020-03-30T02:46:33Z',
            'fundingSources' => $expectedFundings,
            'id' => 'orderId',
            'metadata' => [],
            'parents' => $expectedParents,
            'paymentDestination' => new Ewallet([
                'createdAt' => '2020-03-30T02:46:26Z',
                'id' => 'PROVIDER',
                'name' => null,
                'pan' => 'P...IDER',
                'token' => null,
                'type' => 'ewallet',
                'updatedAt' => '2020-03-30T02:46:33Z',
                'currency' => 'AUD',
                'primary' => true,
                'reference' => 'PROVIDER',
                'user' => new User([
                    'createdAt' => '2020-03-30T02:46:16Z',
                    'email' => 'provider@example.com',
                    'id' => null,
                    'updatedAt' => '2020-03-30T02:46:26Z',
                ])
            ]),
            'paymentSource' => new Ewallet([
                'createdAt' => '2020-03-30T02:46:27Z',
                'id' => 'TRANSACT',
                'name' => null,
                'pan' => 'T...SACT',
                'token' => null,
                'type' => 'ewallet',
                'updatedAt' => '2020-03-30T02:46:33Z',
                'currency' => 'AUD',
                'primary' => true,
                'reference' => 'TRANSACT',
                'user' => new User([
                    'createdAt' => '2020-03-30T02:46:27Z',
                    'email' => 'transactor@example.com',
                    'id' => null,
                    'updatedAt' => '2020-03-30T02:46:27Z',
                ])
            ]),
            'recurringId' => null,
            'response' => [
                'acquirer_code' => '0',
                'acquirer_message' => 'Approved',
                'gateway_message' => null,
            ],
            'security' => null,
            'statementDescription' => 'PAYMENT GATEWAY ORDERID',
            'state' => 80,
            'status' => 'completed',
            'transactionId' => 'transactionId',
            'updatedAt' => '2020-03-30T02:46:33Z',
            'user' => new User([
                'createdAt' => '2020-03-30T02:46:27Z',
                'email' => 'transactor@example.com',
                'id' => null,
                'updatedAt' => '2020-03-30T02:46:27Z',
            ])
        ]);

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\V2\Transaction $actual
         */
        $actual = $this->createApiManager($this->createResponse($response))
            ->create((string)\getenv('PAYMENTS_API_KEY'), $request);

        self::assertEquals($expected, $actual);

        // assert getters on transaction.
        self::assertSame('transfer', $actual->getAction());
        self::assertEquals($expectedParents, $actual->getParents());
        self::assertEquals($expectedFundings, $actual->getFundingSources());
        self::assertSame('PAYMENT GATEWAY ORDERID', $actual->getStatementDescription());
    }
}
