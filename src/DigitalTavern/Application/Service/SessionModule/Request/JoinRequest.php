<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class JoinRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class JoinRequest implements ServiceRequestInterface
{
    /**
     * Session channel
     *
     * @var string
     */
    private $channel;

    /**
     * Requesting user ID
     *
     * @var int
     */
    private $userId;

    /**
     * Session password, empty if session is public
     *
     * @var null|string
     */
    private $password;

    /**
     * Returns session channel
     *
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * Sets session channel
     *
     * @param string $channel
     */
    public function setChannel(string $channel): void
    {
        $this->channel = $channel;
    }

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

    /**
     * Returns session password
     *
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets session password
     *
     * @param null|string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}