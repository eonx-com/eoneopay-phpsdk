<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait WebhookTrait
{
    /**
     * Headers.
     *
     * @Groups({"create", "update"})
     *
     * @var mixed[]
     */
    protected $headers;

    /**
     * Webhook id.
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * Url.
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $url;
}
