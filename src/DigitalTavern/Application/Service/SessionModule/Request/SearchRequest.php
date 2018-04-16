<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class SearchRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class SearchRequest implements ServiceRequestInterface
{
    /**
     * Search query
     *
     * @var string
     */
    private $query;

    /**
     * Searched sessions type
     *
     * @var string
     */
    private $type;

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
        $this->limit = 20;
    }

    /**
     * Returns search query
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Sets search query
     *
     * @param string $query
     */
    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    /**
     * Returns sessions type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets sessions type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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