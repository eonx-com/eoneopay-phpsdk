<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Abstracts\Requests;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Payloads\Transaction;
use EoneoPay\PhpSdk\Traits\DefinesUris;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestMethodInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractTransactionRequest extends AbstractDataTransferObject implements RequestMethodInterface
{
    use DefinesUris {
        url as protected traitUrl;
    }

    /**
     * @Assert\NotNull(groups={"create", "delete", "get", "update"})
     * @Assert\Valid(groups={"create", "delete", "get", "update"})
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Gateway
     */
    protected $gateway;

    /**
     * @Assert\NotNull(groups={"create", "delete", "update"})
     * @Assert\Valid(groups={"create", "delete", "update"})
     *
     * @Groups({"create", "delete", "update"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\Transaction
     */
    protected $transaction;

    /**
     * Get gateway.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\Gateway
     */
    public function getGateway(): ?Gateway
    {
        return $this->gateway;
    }

    /**
     * Get transaction.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\Transaction
     */
    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Add options along with sending the request. For example, adding api key in the header.
     *
     * @return null|mixed[]
     */
    public function options(): array
    {
        return [];
    }

    /**
     * Get transaction url for given endpoint.
     *
     * @param string $endpoint
     *
     * @return string
     */
    protected function url(string $endpoint): string
    {
        return $this->traitUrl(\sprintf('transactions/%s', $endpoint));
    }
}
