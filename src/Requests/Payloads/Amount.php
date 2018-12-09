<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Traits\Requests\Payloads\AmountTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @method null|string getCurrency()
 * @method null|string getPaymentFee()
 * @method null|string getSubtotal()
 * @method null|string getTotal()
 *
 * @Assert\Callback(callback="validateAmount")
 */
class Amount extends BaseDataTransferObject
{
    use AmountTrait;

    /**
     * Validate amount total / subtotal
     *
     * @param \Symfony\Component\Validator\Context\ExecutionContextInterface $context
     *
     * @return void
     */
    public function validateAmount(ExecutionContextInterface $context): void
    {
        if ($this->total === null && $this->subtotal === null) {
            $context->buildViolation('Provide either total or subtotal amount')
                ->atPath('amount')
                ->addViolation();
        }
    }
}
