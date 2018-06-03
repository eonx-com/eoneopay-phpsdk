<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Abstracts\Requests\AbstractTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\BankAccount;
use EoneoPay\PhpSdk\Responses\Payloads\TokenisedBankAccount;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class BankAccountTokenRequest extends AbstractTokenRequest implements RequestObjectInterface
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\BankAccount
     */
    protected $bankAccount;

    /**
     * Specify the expected returned object.
     *
     * @return string
     */
    public function expectObject(): ?string
    {
        return TokenisedBankAccount::class;
    }

    /**
     * Get bank_account.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\BankAccount
     */
    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
    }
}
