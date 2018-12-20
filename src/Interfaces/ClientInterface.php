<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

use GuzzleHttp\Handler\MockHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;

interface ClientInterface
{
    /**
     * Perform a create request
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface $request The object to create
     *
     * @return mixed Returns the object of the expected class
     */
    public function create(RequestObjectInterface $request);

    /**
     * Perform a delete request
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface $request The object to delete
     *
     * @return mixed Returns the object of the expected class
     */
    public function delete(RequestObjectInterface $request);

    /**
     * Perform a get request
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface $request The object to get
     *
     * @return mixed Returns the object of the expected class
     */
    public function get(RequestObjectInterface $request);

    /**
     * Perform a list request
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface $request The object to list
     *
     * @return mixed Returns the object of the expected class
     */
    public function list(RequestObjectInterface $request);

    /**
     * Set api key
     *
     * @param string|null $apiKey The api key to use for authentication
     *
     * @return static
     */
    public function setApiKey(?string $apiKey = null);

    /**
     * Set base uri
     *
     * @param string $baseUri The base uri to request against
     *
     * @return static
     */
    public function setBaseUri(string $baseUri);

    /**
     * Set mock handler
     *
     * @param \GuzzleHttp\Handler\MockHandler|null $handler The handler to set against the client
     *
     * @return static
     */
    public function setHandler(?MockHandler $handler = null);

    /**
     * Perform an update request
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface $request The object to update
     *
     * @return mixed Returns the object of the expected class
     */
    public function update(RequestObjectInterface $request);
}
