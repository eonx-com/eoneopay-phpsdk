<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException;
use EoneoPay\PhpSdk\Interfaces\ClientInterface;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Client as BaseClient;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;

class Client implements ClientInterface
{
    /**
     * Api key to use for authentication
     *
     * @var string|null
     */
    private $apiKey;

    /**
     * Base uri to send requests to
     *
     * @var string
     */
    private $baseUri;

    /**
     * Handler to set against the guzzle client
     *
     * @var \GuzzleHttp\Handler\MockHandler|null
     */
    private $handler;

    /**
     * Configured sdk client instance
     *
     * @var \LoyaltyCorp\SdkBlueprint\Sdk\Client|null
     */
    private $sdkClient;

    /**
     * @inheritdoc
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function create(RequestObjectInterface $request)
    {
        return $this->request('create', $request);
    }

    /**
     * @inheritdoc
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function delete(RequestObjectInterface $request)
    {
        return $this->request('delete', $request);
    }

    /**
     * @inheritdoc
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function get(RequestObjectInterface $request)
    {
        return $this->request('get', $request);
    }

    /**
     * @inheritdoc
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function list(RequestObjectInterface $request)
    {
        return $this->request('list', $request);
    }

    /**
     * @inheritdoc
     */
    public function setApiKey(?string $apiKey = null)
    {
        return $this->set('apiKey', $apiKey);
    }

    /**
     * @inheritdoc
     */
    public function setBaseUri(string $baseUri)
    {
        return $this->set('baseUri', $baseUri);
    }

    /**
     * Set handler to use with guzzle client
     *
     * @param \GuzzleHttp\Handler\MockHandler|null $handler The handler to set
     *
     * @return static
     */
    public function setHandler(?MockHandler $handler = null)
    {
        return $this->set('handler', $handler);
    }

    /**
     * @inheritdoc
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    public function update(RequestObjectInterface $request)
    {
        return $this->request('update', $request);
    }

    /**
     * Perform a request against the sdk
     *
     * @param string $action The action to perform
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface $request The request object
     *
     * @return mixed Returns the object of the expected class
     *
     * @throws \EoneoPay\PhpSdk\Exceptions\ClientNotConfiguredException If no base uri or handler has been set
     */
    private function request(string $action, RequestObjectInterface $request)
    {
        // If sdk hasn't been created, create it
        if (($this->sdkClient instanceof BaseClient) === false) {
            $options = [
                'auth' => [$this->apiKey, null],
                'base_uri' => $this->baseUri
            ];

            // Only add handler if provided
            if ($this->handler instanceof MockHandler) {
                $options['handler'] = $this->handler;
            }

            // If both base_uri and handler are empty, throw exception
            if (($options['base_uri'] ?? $options['handler'] ?? null) === null) {
                throw new ClientNotConfiguredException('No base uri or handler set, can not continue');
            }

            $this->sdkClient = new BaseClient(new Guzzle($options));
        }

        return $this->sdkClient->{$action}($request);
    }

    /**
     * Set a property
     *
     * @param string $property The property to set
     * @param mixed $value The value to set
     *
     * @return static
     */
    private function set(string $property, $value): self
    {
        // Set property
        $this->{$property} = $value;

        // Reset client so it has to be instantiated again
        $this->sdkClient = null;

        return $this;
    }
}
