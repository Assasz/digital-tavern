<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class LeaveResponse
 *
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class LeaveResponse implements ServiceResponseInterface
{
    /**
     * Updated user
     *
     * @var null|User
     */
    private $user;

    /**
     * Returns user
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Sets user
     *
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }
}