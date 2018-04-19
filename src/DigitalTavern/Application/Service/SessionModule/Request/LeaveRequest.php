<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class LeaveRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class LeaveRequest implements ServiceRequestInterface
{
    /**
     * Session channel
     *
     * @var string $channel
     */
    private $channel;

    /**
     * Requesting user
     *
     * @var User
     */
    private $user;

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
     * Returns user
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Sets user
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}