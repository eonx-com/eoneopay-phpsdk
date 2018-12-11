<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces\Requests\Fees;

interface ContractRequestInterface
{
    /**
     * Group name for bank account.
     *
     * @const string
     */
    public const GROUP_BANK_ACCOUNT = 'Bank Account';

    /**
     * Group name for American Express credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_AMERICAN_EXPRESS = 'American Express';

    /**
     * Group name for Diners Club credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_DINERS_CLUB = 'Diners Club';

    /**
     * Group name for Discover credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_DISCOVER = 'Discover';

    /**
     * Group name for JCB credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_JCB = 'JCB';

    /**
     * Group name for Mastercard credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_MASTERCARD = 'Mastercard';

    /**
     * Group name for Visa credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_VISA = 'VISA';

    /**
     * Group name for UnionPay credit cards.
     *
     * @const string
     */
    public const GROUP_CREDIT_CARD_UNIONPAY = 'UnionPay';

    /**
     * Group name for Ewallet.
     *
     * @const string
     */
    public const GROUP_EWALLET = 'Ewallet';
}
