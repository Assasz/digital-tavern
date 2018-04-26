<?php

namespace DigitalTavern\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetAvailableResponse
 *
 * @package DigitalTavern\Application\Service\UserModule\Response
 */
class GetAvailableResponse implements ServiceResponseInterface
{
    /**
     * Available users
     *
     * @var array
     */
    private $users;

    public function __construct()
    {
        $this->users = [];
    }

    /**
     * Returns users
     *
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * Sets users
     *
     * @param array $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}