<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Responses\Transactions;

use LoyaltyCorp\SdkBlueprint\Sdk\BaseDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @method null|string getAcquirerCode()
 * @method null|string getAcquirerMessage()
 * @method null|string getGatewayMessage()
 */
class Response extends BaseDataTransferObject
{
    /**
     * Acquirer code
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $acquirerCode;

    /**
     * Acquirer message
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $acquirerMessage;

    /**
     * Gateway message
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $gatewayMessage;
}
