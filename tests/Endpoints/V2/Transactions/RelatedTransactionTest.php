<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2\Transactions;

use EoneoPay\PhpSdk\Endpoints\V2\Amount;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet;
use EoneoPay\PhpSdk\Endpoints\V2\Transaction;
use EoneoPay\PhpSdk\Endpoints\V2\Transactions\RelatedTransaction;
use EoneoPay\PhpSdk\Endpoints\V2\User;
use Tests\EoneoPay\PhpSdk\TestCases\TransactionTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Transactions\RelatedTransaction
 */
class RelatedTransactionTest extends TransactionTestCase
{
    /**
     * Test response and getters.
     *
     * @return void
     */
    public function testResponseAndGetters(): void
    {
        $response = [
            'children' => [
                [
                    'action' => 'debit',
                    'allocation' => null,
                    'amount' => [
                        'currency' => 'AUD',
                        'payment_fee' => '0.00',
                        'subtotal' => '100.00',
                        'total' => '100.00',
                    ],
                    'approved' => true,
                    'created_at' => ':fuzzy:',
                    'description' => null,
                    'finalised' => false,
                    'finalised_at' => ':fuzzy:',
                    'funding_sources' => [
                        [
                            'amount' => [
                                'currency' => 'AUD',
                                'payment_fee' => '0.00',
                                'subtotal' => '100.00',
                                'total' => '100.00',
                            ],
                            'bin' => [
                                'bin' => ':fuzzy:',
                                'category' => 'Test',
                                'country' => 'AU',
                                'created_at' => ':fuzzy:',
                                'funding_source' => 'CREDIT',
                                'issuer' => 'BANK OF LOYALTYCORP',
                                'prepaid' => false,
                                'scheme' => 'TEST',
                                'updated_at' => ':fuzzy:',
                            ],
                            'created_at' => ':fuzzy:',
                            'expiry' => [
                                'month' => '03',
                                'year' => '2021'
                            ],
                            'facility' => 'Visa',
                            'id' => ':fuzzy:',
                            'pan' => ':fuzzy:',
                            'type' => 'credit_card',
                            'updated_at' => ':fuzzy:',
                        ]
                    ],
                    'id' => 'child',
                    'metadata' => [],
                    'parents' => [
                        [
                            'action' => 'debit',
                            'allocation' => null,
                            'amount' => [
                                'currency' => 'AUD',
                                'payment_fee' => '0.00',
                                'subtotal' => '100.00',
                                'total' => '100.00',
                            ],
                            'approved' => true,
                            'created_at' => ':fuzzy:',
                            'description' => null,
                            'finalised' => false,
                            'finalised_at' => ':fuzzy:',
                            'funding_sources' => [
                                [
                                    'amount' => [
                                        'currency' => 'AUD',
                                        'payment_fee' => '0.00',
                                        'subtotal' => '100.00',
                                        'total' => '100.00',
                                    ],
                                    'bin' => [
                                        'bin' => ':fuzzy:',
                                        'category' => 'Test',
                                        'country' => 'AU',
                                        'created_at' => ':fuzzy:',
                                        'funding_source' => 'CREDIT',
                                        'issuer' => 'BANK OF LOYALTYCORP',
                                        'prepaid' => false,
                                        'scheme' => 'TEST',
                                        'updated_at' => ':fuzzy:',
                                    ],
                                    'created_at' => ':fuzzy:',
                                    'expiry' => [
                                        'month' => '03',
                                        'year' => '2021'
                                    ],
                                    'facility' => 'Visa',
                                    'id' => ':fuzzy:',
                                    'pan' => ':fuzzy:',
                                    'type' => 'credit_card',
                                    'updated_at' => ':fuzzy:',
                                ]
                            ],
                            'id' => 'order',
                            'metadata' => [],
                            'parents' => [
                                [
                                    'action' => 'debit',
                                    'allocation' => null,
                                    'amount' => [
                                        'currency' => 'AUD',
                                        'payment_fee' => '0.00',
                                        'subtotal' => '100.00',
                                        'total' => '100.00',
                                    ],
                                    'approved' => true,
                                    'created_at' => ':fuzzy:',
                                    'description' => null,
                                    'finalised' => false,
                                    'finalised_at' => ':fuzzy:',
                                    'funding_sources' => [],
                                    'id' => 'parent',
                                    'metadata' => [],
                                    'parents' => [],
                                    'payment_destination' => [
                                        'balances' => [
                                            'available' => '0.00',
                                            'balance' => '100.00',
                                            'credit_limit' => null
                                        ],
                                        'created_at' => ':fuzzy:',
                                        'currency' => 'AUD',
                                        'id' => ':fuzzy:',
                                        'pan' => ':fuzzy:',
                                        'primary' => true,
                                        'reference' => ':fuzzy:',
                                        'type' => 'ewallet',
                                        'updated_at' => ':fuzzy:',
                                        'user' => [
                                            'created_at' => ':fuzzy:',
                                            'email' => 'user@example.com',
                                            'metadata' => [],
                                            'name' => null,
                                            'updated_at' => ':fuzzy:',
                                        ],
                                    ],
                                    'payment_source' => [
                                        'bin' => [
                                            'bin' => ':fuzzy:',
                                            'category' => 'Test',
                                            'country' => 'AU',
                                            'created_at' => ':fuzzy:',
                                            'funding_source' => 'CREDIT',
                                            'issuer' => 'BANK OF LOYALTYCORP',
                                            'prepaid' => false,
                                            'scheme' => 'TEST',
                                            'updated_at' => ':fuzzy:',
                                        ],
                                        'created_at' => ':fuzzy:',
                                        'expiry' => [
                                            'month' => '03',
                                            'year' => '2021'
                                        ],
                                        'facility' => 'Visa',
                                        'id' => ':fuzzy:',
                                        'name' => null, // No token attached means no name.
                                        'pan' => ':fuzzy:',
                                        'token' => null,
                                        'type' => 'credit_card',
                                        'updated_at' => ':fuzzy:',
                                    ],
                                    'recurring_id' => null,
                                    'response' => [
                                        'acquirer_code' => null,
                                        'acquirer_message' => null,
                                        'gateway_message' => null,
                                    ],
                                    'security' => null,
                                    'state' => 11,
                                    'statement_description' => 'TEST ORDER 123',
                                    'status' => 'pending',
                                    'transaction_id' => 'transaction',
                                    'updated_at' => ':fuzzy:',
                                    'user' => [
                                        'created_at' => ':fuzzy:',
                                        'email' => 'user@example.com',
                                        'metadata' => [],
                                        'name' => null,
                                        'updated_at' => ':fuzzy:',
                                    ],
                                ]
                            ],
                            'payment_destination' => [
                                'balances' => [
                                    'available' => '0.00',
                                    'balance' => '100.00',
                                    'credit_limit' => null,
                                ],
                                'created_at' => ':fuzzy:',
                                'currency' => 'AUD',
                                'id' => ':fuzzy:',
                                'pan' => ':fuzzy:',
                                'primary' => false,
                                'reference' => ':fuzzy:',
                                'type' => 'ewallet',
                                'updated_at' => ':fuzzy:',
                                'user' => [
                                    'created_at' => ':fuzzy:',
                                    'email' => 'user@example.com',
                                    'metadata' => [],
                                    'name' => null,
                                    'updated_at' => ':fuzzy:',
                                ],
                            ],
                            'payment_source' => [
                                'bin' => [
                                    'bin' => ':fuzzy:',
                                    'category' => 'Test',
                                    'country' => 'AU',
                                    'created_at' => ':fuzzy:',
                                    'funding_source' => 'CREDIT',
                                    'issuer' => 'BANK OF LOYALTYCORP',
                                    'prepaid' => false,
                                    'scheme' => 'TEST',
                                    'updated_at' => ':fuzzy:',
                                ],
                                'created_at' => ':fuzzy:',
                                'expiry' => [
                                    'month' => '03',
                                    'year' => '2021'
                                ],
                                'facility' => 'Visa',
                                'id' => ':fuzzy:',
                                'name' => null, // No token attached means no name.
                                'pan' => ':fuzzy:',
                                'token' => null,
                                'type' => 'credit_card',
                                'updated_at' => ':fuzzy:',
                            ],
                            'recurring_id' => null,
                            'response' => [
                                'acquirer_code' => null,
                                'acquirer_message' => null,
                                'gateway_message' => null,
                            ],
                            'security' => null,
                            'state' => 11,
                            'statement_description' => 'TEST ORDER 123',
                            'status' => 'pending',
                            'transaction_id' => 'transaction',
                            'updated_at' => ':fuzzy:',
                            'user' => [
                                'created_at' => ':fuzzy:',
                                'email' => 'user@example.com',
                                'metadata' => [],
                                'name' => null,
                                'updated_at' => ':fuzzy:',
                            ],
                        ],
                    ],
                    'payment_destination' => [
                        'balances' => [
                            'available' => '0.00',
                            'balance' => '100.00',
                            'credit_limit' => null,
                        ],
                        'created_at' => ':fuzzy:',
                        'currency' => 'AUD',
                        'id' => ':fuzzy:',
                        'pan' => ':fuzzy:',
                        'primary' => false,
                        'reference' => ':fuzzy:',
                        'type' => 'ewallet',
                        'updated_at' => ':fuzzy:',
                        'user' => [
                            'created_at' => ':fuzzy:',
                            'email' => 'user@example.com',
                            'metadata' => [],
                            'name' => null,
                            'updated_at' => ':fuzzy:',
                        ],
                    ],
                    'payment_source' => [
                        'bin' => [
                            'bin' => ':fuzzy:',
                            'category' => 'Test',
                            'country' => 'AU',
                            'created_at' => ':fuzzy:',
                            'funding_source' => 'CREDIT',
                            'issuer' => 'BANK OF LOYALTYCORP',
                            'prepaid' => false,
                            'scheme' => 'TEST',
                            'updated_at' => ':fuzzy:',
                        ],
                        'created_at' => ':fuzzy:',
                        'expiry' => [
                            'month' => '03',
                            'year' => '2021'
                        ],
                        'facility' => 'Visa',
                        'id' => ':fuzzy:',
                        'name' => null, // No token attached means no name.
                        'pan' => ':fuzzy:',
                        'token' => null,
                        'type' => 'credit_card',
                        'updated_at' => ':fuzzy:',
                    ],
                    'recurring_id' => null,
                    'response' => [
                        'acquirer_code' => null,
                        'acquirer_message' => null,
                        'gateway_message' => null,
                    ],
                    'security' => null,
                    'state' => 11,
                    'statement_description' => 'TEST ORDER 123',
                    'status' => 'pending',
                    'transaction_id' => 'transaction',
                    'updated_at' => ':fuzzy:',
                    'user' => [
                        'created_at' => ':fuzzy:',
                        'email' => 'user@example.com',
                        'metadata' => [],
                        'name' => null,
                        'updated_at' => ':fuzzy:',
                    ],
                ]
            ],
            'parents' => [
                [
                    'action' => 'debit',
                    'allocation' => null,
                    'amount' => [
                        'currency' => 'AUD',
                        'payment_fee' => '0.00',
                        'subtotal' => '100.00',
                        'total' => '100.00',
                    ],
                    'approved' => true,
                    'created_at' => ':fuzzy:',
                    'description' => null,
                    'finalised' => false,
                    'finalised_at' => ':fuzzy:',
                    'funding_sources' => [],
                    'id' => 'parent',
                    'metadata' => [],
                    'parents' => [],
                    'payment_destination' => [
                        'balances' => [
                            'available' => '0.00',
                            'balance' => '100.00',
                            'credit_limit' => null,
                        ],
                        'created_at' => ':fuzzy:',
                        'currency' => 'AUD',
                        'id' => ':fuzzy:',
                        'pan' => ':fuzzy:',
                        'primary' => true,
                        'reference' => ':fuzzy:',
                        'type' => 'ewallet',
                        'updated_at' => ':fuzzy:',
                        'user' => [
                            'created_at' => ':fuzzy:',
                            'email' => 'user@example.com',
                            'metadata' => [],
                            'name' => null,
                            'updated_at' => ':fuzzy:',
                        ],
                    ],
                    'payment_source' => [
                        'bin' => [
                            'bin' => ':fuzzy:',
                            'category' => 'Test',
                            'country' => 'AU',
                            'created_at' => ':fuzzy:',
                            'funding_source' => 'CREDIT',
                            'issuer' => 'BANK OF LOYALTYCORP',
                            'prepaid' => false,
                            'scheme' => 'TEST',
                            'updated_at' => ':fuzzy:',
                        ],
                        'created_at' => ':fuzzy:',
                        'expiry' => [
                            'month' => '03',
                            'year' => '2021'
                        ],
                        'facility' => 'Visa',
                        'id' => ':fuzzy:',
                        'name' => null, // No token attached means no name.
                        'pan' => ':fuzzy:',
                        'token' => null,
                        'type' => 'credit_card',
                        'updated_at' => ':fuzzy:',
                    ],
                    'recurring_id' => null,
                    'response' => [
                        'acquirer_code' => null,
                        'acquirer_message' => null,
                        'gateway_message' => null,
                    ],
                    'security' => null,
                    'state' => 11,
                    'statement_description' => 'TEST ORDER 123',
                    'status' => 'pending',
                    'transaction_id' => 'transaction',
                    'updated_at' => ':fuzzy:',
                    'user' => [
                        'created_at' => ':fuzzy:',
                        'email' => 'user@example.com',
                        'metadata' => [],
                        'name' => null,
                        'updated_at' => ':fuzzy:',
                    ],
                ]
            ]
        ];

        $expectedChildren = [
            new Transaction([

                'action' => 'debit',
                'allocation' => null,
                'amount' => new Amount([
                    'currency' => 'AUD',
                    'payment_fee' => '0.00',
                    'subtotal' => '100.00',
                    'total' => '100.00',
                ]),
                'approved' => true,
                'created_at' => ':fuzzy:',
                'description' => null,
                'finalised' => false,
                'finalised_at' => ':fuzzy:',
                'funding_sources' => [
                    new CreditCard([
                        'amount' => [
                            'currency' => 'AUD',
                            'payment_fee' => '0.00',
                            'subtotal' => '100.00',
                            'total' => '100.00',
                        ],
                        'bin' => [
                            'bin' => ':fuzzy:',
                            'category' => 'Test',
                            'country' => 'AU',
                            'created_at' => ':fuzzy:',
                            'funding_source' => 'CREDIT',
                            'issuer' => 'BANK OF LOYALTYCORP',
                            'prepaid' => false,
                            'scheme' => 'TEST',
                            'updated_at' => ':fuzzy:',
                        ],
                        'created_at' => ':fuzzy:',
                        'expiry' => [
                            'month' => '03',
                            'year' => '2021'
                        ],
                        'facility' => 'Visa',
                        'id' => ':fuzzy:',
                        'pan' => ':fuzzy:',
                        'type' => 'credit_card',
                        'updated_at' => ':fuzzy:',
                    ])
                ],
                'id' => 'child',
                'metadata' => [],
                'parents' => [
                    new Transaction([
                        'action' => 'debit',
                        'allocation' => null,
                        'amount' => new Amount([
                            'currency' => 'AUD',
                            'payment_fee' => '0.00',
                            'subtotal' => '100.00',
                            'total' => '100.00',
                        ]),
                        'approved' => true,
                        'created_at' => ':fuzzy:',
                        'description' => null,
                        'finalised' => false,
                        'finalised_at' => ':fuzzy:',
                        'funding_sources' => [
                            new CreditCard([
                                'amount' => [
                                    'currency' => 'AUD',
                                    'payment_fee' => '0.00',
                                    'subtotal' => '100.00',
                                    'total' => '100.00',
                                ],
                                'bin' => [
                                    'bin' => ':fuzzy:',
                                    'category' => 'Test',
                                    'country' => 'AU',
                                    'created_at' => ':fuzzy:',
                                    'funding_source' => 'CREDIT',
                                    'issuer' => 'BANK OF LOYALTYCORP',
                                    'prepaid' => false,
                                    'scheme' => 'TEST',
                                    'updated_at' => ':fuzzy:',
                                ],
                                'created_at' => ':fuzzy:',
                                'expiry' => [
                                    'month' => '03',
                                    'year' => '2021'
                                ],
                                'facility' => 'Visa',
                                'id' => ':fuzzy:',
                                'pan' => ':fuzzy:',
                                'type' => 'credit_card',
                                'updated_at' => ':fuzzy:',
                            ])
                        ],
                        'id' => 'order',
                        'metadata' => [],
                        'parents' => [
                            new Transaction([
                                'action' => 'debit',
                                'allocation' => null,
                                'amount' => new Amount([
                                    'currency' => 'AUD',
                                    'payment_fee' => '0.00',
                                    'subtotal' => '100.00',
                                    'total' => '100.00',
                                ]),
                                'approved' => true,
                                'created_at' => ':fuzzy:',
                                'description' => null,
                                'finalised' => false,
                                'finalised_at' => ':fuzzy:',
                                'funding_sources' => [],
                                'id' => 'parent',
                                'metadata' => [],
                                'parents' => [],
                                'payment_destination' => new Ewallet([
                                    'created_at' => ':fuzzy:',
                                    'currency' => 'AUD',
                                    'id' => ':fuzzy:',
                                    'pan' => ':fuzzy:',
                                    'primary' => true,
                                    'reference' => ':fuzzy:',
                                    'type' => 'ewallet',
                                    'updated_at' => ':fuzzy:',
                                    'user' => new User([
                                        'created_at' => ':fuzzy:',
                                        'email' => 'user@example.com',
                                        'metadata' => [],
                                        'name' => null,
                                        'updated_at' => ':fuzzy:',
                                    ]),
                                ]),
                                'payment_source' => new CreditCard([
                                    'bin' => [
                                        'bin' => ':fuzzy:',
                                        'category' => 'Test',
                                        'country' => 'AU',
                                        'created_at' => ':fuzzy:',
                                        'funding_source' => 'CREDIT',
                                        'issuer' => 'BANK OF LOYALTYCORP',
                                        'prepaid' => false,
                                        'scheme' => 'TEST',
                                        'updated_at' => ':fuzzy:',
                                    ],
                                    'created_at' => ':fuzzy:',
                                    'expiry' => [
                                        'month' => '03',
                                        'year' => '2021'
                                    ],
                                    'facility' => 'Visa',
                                    'id' => ':fuzzy:',
                                    'name' => null, // No token attached means no name.
                                    'pan' => ':fuzzy:',
                                    'token' => null,
                                    'type' => 'credit_card',
                                    'updated_at' => ':fuzzy:',
                                ]),
                                'recurring_id' => null,
                                'response' => [
                                    'acquirer_code' => null,
                                    'acquirer_message' => null,
                                    'gateway_message' => null,
                                ],
                                'security' => null,
                                'state' => 11,
                                'statement_description' => 'TEST ORDER 123',
                                'status' => 'pending',
                                'transaction_id' => 'transaction',
                                'updated_at' => ':fuzzy:',
                                'user' => new User([
                                    'created_at' => ':fuzzy:',
                                    'email' => 'user@example.com',
                                    'metadata' => [],
                                    'name' => null,
                                    'updated_at' => ':fuzzy:',
                                ]),
                            ])
                        ],
                        'payment_destination' => new Ewallet([
                            'created_at' => ':fuzzy:',
                            'currency' => 'AUD',
                            'id' => ':fuzzy:',
                            'pan' => ':fuzzy:',
                            'primary' => false,
                            'reference' => ':fuzzy:',
                            'type' => 'ewallet',
                            'updated_at' => ':fuzzy:',
                            'user' => new User([
                                'created_at' => ':fuzzy:',
                                'email' => 'user@example.com',
                                'metadata' => [],
                                'name' => null,
                                'updated_at' => ':fuzzy:',
                            ]),
                        ]),
                        'payment_source' => new CreditCard([
                            'bin' => [
                                'bin' => ':fuzzy:',
                                'category' => 'Test',
                                'country' => 'AU',
                                'created_at' => ':fuzzy:',
                                'funding_source' => 'CREDIT',
                                'issuer' => 'BANK OF LOYALTYCORP',
                                'prepaid' => false,
                                'scheme' => 'TEST',
                                'updated_at' => ':fuzzy:',
                            ],
                            'created_at' => ':fuzzy:',
                            'expiry' => [
                                'month' => '03',
                                'year' => '2021'
                            ],
                            'facility' => 'Visa',
                            'id' => ':fuzzy:',
                            'name' => null, // No token attached means no name.
                            'pan' => ':fuzzy:',
                            'token' => null,
                            'type' => 'credit_card',
                            'updated_at' => ':fuzzy:',
                        ]),
                        'recurring_id' => null,
                        'response' => [
                            'acquirer_code' => null,
                            'acquirer_message' => null,
                            'gateway_message' => null,
                        ],
                        'security' => null,
                        'state' => 11,
                        'statement_description' => 'TEST ORDER 123',
                        'status' => 'pending',
                        'transaction_id' => 'transaction',
                        'updated_at' => ':fuzzy:',
                        'user' => new User([
                            'created_at' => ':fuzzy:',
                            'email' => 'user@example.com',
                            'metadata' => [],
                            'name' => null,
                            'updated_at' => ':fuzzy:',
                        ]),
                    ]),
                ],
                'payment_destination' => new Ewallet([
                    'created_at' => ':fuzzy:',
                    'currency' => 'AUD',
                    'id' => ':fuzzy:',
                    'pan' => ':fuzzy:',
                    'primary' => false,
                    'reference' => ':fuzzy:',
                    'type' => 'ewallet',
                    'updated_at' => ':fuzzy:',
                    'user' => new User([
                        'created_at' => ':fuzzy:',
                        'email' => 'user@example.com',
                        'metadata' => [],
                        'name' => null,
                        'updated_at' => ':fuzzy:',
                    ]),
                ]),
                'payment_source' => new CreditCard([
                    'bin' => [
                        'bin' => ':fuzzy:',
                        'category' => 'Test',
                        'country' => 'AU',
                        'created_at' => ':fuzzy:',
                        'funding_source' => 'CREDIT',
                        'issuer' => 'BANK OF LOYALTYCORP',
                        'prepaid' => false,
                        'scheme' => 'TEST',
                        'updated_at' => ':fuzzy:',
                    ],
                    'created_at' => ':fuzzy:',
                    'expiry' => [
                        'month' => '03',
                        'year' => '2021'
                    ],
                    'facility' => 'Visa',
                    'id' => ':fuzzy:',
                    'name' => null, // No token attached means no name.
                    'pan' => ':fuzzy:',
                    'token' => null,
                    'type' => 'credit_card',
                    'updated_at' => ':fuzzy:',
                ]),
                'recurring_id' => null,
                'response' => [
                    'acquirer_code' => null,
                    'acquirer_message' => null,
                    'gateway_message' => null,
                ],
                'security' => null,
                'state' => 11,
                'statement_description' => 'TEST ORDER 123',
                'status' => 'pending',
                'transaction_id' => 'transaction',
                'updated_at' => ':fuzzy:',
                'user' => new User([
                    'created_at' => ':fuzzy:',
                    'email' => 'user@example.com',
                    'metadata' => [],
                    'name' => null,
                    'updated_at' => ':fuzzy:',
                ]),
            ])
        ];
        $expectedParents = [
            new Transaction([
                'action' => 'debit',
                'allocation' => null,
                'amount' => new Amount([
                    'currency' => 'AUD',
                    'payment_fee' => '0.00',
                    'subtotal' => '100.00',
                    'total' => '100.00',
                ]),
                'approved' => true,
                'created_at' => ':fuzzy:',
                'description' => null,
                'finalised' => false,
                'finalised_at' => ':fuzzy:',
                'funding_sources' => [],
                'id' => 'parent',
                'metadata' => [],
                'parents' => [],
                'payment_destination' => new Ewallet([
                    'created_at' => ':fuzzy:',
                    'currency' => 'AUD',
                    'id' => ':fuzzy:',
                    'pan' => ':fuzzy:',
                    'primary' => true,
                    'reference' => ':fuzzy:',
                    'type' => 'ewallet',
                    'updated_at' => ':fuzzy:',
                    'user' => new User([
                        'created_at' => ':fuzzy:',
                        'email' => 'user@example.com',
                        'metadata' => [],
                        'name' => null,
                        'updated_at' => ':fuzzy:',
                    ]),
                ]),
                'payment_source' => new CreditCard([
                    'bin' => [
                        'bin' => ':fuzzy:',
                        'category' => 'Test',
                        'country' => 'AU',
                        'created_at' => ':fuzzy:',
                        'funding_source' => 'CREDIT',
                        'issuer' => 'BANK OF LOYALTYCORP',
                        'prepaid' => false,
                        'scheme' => 'TEST',
                        'updated_at' => ':fuzzy:',
                    ],
                    'created_at' => ':fuzzy:',
                    'expiry' => [
                        'month' => '03',
                        'year' => '2021'
                    ],
                    'facility' => 'Visa',
                    'id' => ':fuzzy:',
                    'name' => null, // No token attached means no name.
                    'pan' => ':fuzzy:',
                    'token' => null,
                    'type' => 'credit_card',
                    'updated_at' => ':fuzzy:',
                ]),
                'recurring_id' => null,
                'response' => [
                    'acquirer_code' => null,
                    'acquirer_message' => null,
                    'gateway_message' => null,
                ],
                'security' => null,
                'state' => 11,
                'statement_description' => 'TEST ORDER 123',
                'status' => 'pending',
                'transaction_id' => 'transaction',
                'updated_at' => ':fuzzy:',
                'user' => new User([
                    'created_at' => ':fuzzy:',
                    'email' => 'user@example.com',
                    'metadata' => [],
                    'name' => null,
                    'updated_at' => ':fuzzy:',
                ]),
            ])
        ];
        $expected = new RelatedTransaction([
            'children' => $expectedChildren,
            'parents' => $expectedParents,
            'orderId' => null,
            'transactionId' => null
        ]);

        $actual = $this->createApiManager($response)
            ->findOneBy(RelatedTransaction::class, (string)\getenv('PAYMENTS_API_KEY'), [
                'orderId' => 'orderId',
                'transactionId' => 'transactionId'
            ]);

        self::assertEquals($expected, $actual);
        self::assertEquals($expectedChildren, $actual->getChildren());
        self::assertEquals($expectedParents, $actual->getParents());
    }

    /**
     * Tests uri's.
     *
     * @return void
     */
    public function testUris(): void
    {
        $expected = [
            'get' => '/orders/orderId/transactions/transactionId/related'
        ];

        $related = new RelatedTransaction(['orderId' => 'orderId', 'transactionId' => 'transactionId']);

        self::assertSame($expected, $related->uris());
    }

}
