<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait EwalletFundingTrait
{
    /**
     * List of funding source from where the funds are drawn.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource[]|null
     */
    protected $endpoints;

    /**
     * The ewallet to fund.
     *
     * @Assert\NotNull()
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\Ewallet")
     *
     * @Groups({"create", "delete"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Ewallet|null
     */
    protected $ewallet;

    /**
     * Ewallet funding id.
     *
     * @Assert\Type(type="string")
     *
     * @Groups({"create", "delete"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Funding source for the ewallet.
     *
     * @Assert\NotNull()
     * @Assert\Type(type="\EoneoPay\PhpSdk\Endpoints\PaymentSource")
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $fundingSource;

    /**
     * Currency to use for amount.
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $targetAmount;

    /**
     * Currency to use for amount.
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $threshold;
}
