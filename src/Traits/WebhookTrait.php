<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait WebhookTrait
{
    /**
     * Webhook id.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * Headers.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]
     */
    protected $headers;

    /**
     * Url.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $url;
}
