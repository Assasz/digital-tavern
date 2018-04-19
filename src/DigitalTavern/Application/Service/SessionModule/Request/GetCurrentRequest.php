<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class GetCurrentRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class GetCurrentRequest implements ServiceRequestInterface
{
    /**
     * Requesting user ID
     *
     * @var int $userId
     */
    private $userId;

    /**
     * Returns user ID
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Sets user ID
     *
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}