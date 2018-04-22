<?php

namespace DigitalTavern\Application\Service\UserModule\Response;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetResponse
 *
 * @package DigitalTavern\Application\Service\UserModule\Response
 */
class GetResponse implements ServiceResponseInterface
{
    /**
     * User instance
     *
     * @var User
     */
    private $user;

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