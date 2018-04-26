<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class SearchRequest
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class SearchRequest implements ServiceRequestInterface
{
    /**
     * User IGN
     *
     * @var string
     */
    private $ign;

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
     * SearchRequest constructor.
     *
     * Sets default values
     */
    public function __construct()
    {
        $this->offset = 0;
        $this->limit = 50;
    }

    /**
     * Returns user IGN
     *
     * @return string
     */
    public function getIgn(): string
    {
        return $this->ign;
    }

    /**
     * Sets user IGN
     *
     * @param string $ign
     */
    public function setIgn(string $ign): void
    {
        $this->ign = $ign;
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