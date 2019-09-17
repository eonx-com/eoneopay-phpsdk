<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces\Endpoints;

interface TransactionInterface
{
    /**
     * Transaction authorise action.
     *
     * @var string
     */
    public const ACTION_AUTHORISE = 'authorise';

    /**
     * Transaction capture action.
     *
     * @var string
     */
    public const ACTION_CAPTURE = 'capture';

    /**
     * Transaction credit action.
     *
     * @var string
     */
    public const ACTION_CREDIT = 'credit';

    /**
     * Transaction debit action.
     *
     * @var string
     */
    public const ACTION_DEBIT = 'debit';

    /**
     * Transaction refund action.
     *
     * @var string
     */
    public const ACTION_REFUND = 'refund';

    /**
     * Transaction transfer action.
     *
     * @var string
     */
    public const ACTION_TRANSFER = 'transfer';
}
