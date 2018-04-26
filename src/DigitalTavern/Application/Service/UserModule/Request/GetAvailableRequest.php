<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class GetAvailableRequest
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class GetAvailableRequest implements ServiceRequestInterface
{
    /**
     * Result offset
     *
     * @var int
     */
    private $offset;

    /**
     * Result limit
     *
     * @var int
     */
    private $limit;

    /**
     * GetAvailableRequest constructor.
     *
     * Sets default values
     */
    public function __construct()
    {
        $this->offset = 0;
        $this->limit = 50;
    }

    /**
     * Returns result offset
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Sets result offset
     *
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * Returns result limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Sets result limit
     *
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }
}