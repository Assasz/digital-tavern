<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class GetPublicRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class GetPublicRequest implements ServiceRequestInterface
{
    /**
     * Query result offset
     *
     * @var int
     */
    private $offset;

    /**
     * Query result limit
     *
     * @var int
     */
    private $limit;

    /**
     * GetPublicRequest constructor.
     *
     * Sets default values
     */
    public function __construct()
    {
        $this->offset = 0;
        $this->limit = 20;
    }

    /**
     * Returns query result offset
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Sets query result offset
     *
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * Returns query result limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Sets query result limit
     *
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }
}