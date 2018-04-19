<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class ChannelCheckResponse implements ServiceResponseInterface
{
    /**
     * Updated instance of user
     *
     * @var User
     */
    private $user;

    /**
     * Returns updated user
     *
     * @return null|User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets updated user
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}