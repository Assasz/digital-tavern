<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class ActivityUpdateRequest
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class ActivityUpdateRequest implements ServiceRequestInterface
{
    /**
     * User ID
     *
     * @var int
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