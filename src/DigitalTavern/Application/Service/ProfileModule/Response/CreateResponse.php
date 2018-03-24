<?php

namespace DigitalTavern\Application\Service\ProfileModule\Response;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class CreateResponse
 *
 * @package DigitalTavern\Application\Service\ProfileModule\Response
 */
class CreateResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * User associated with created profile
     *
     * @var User
     */
    private $user;

    /**
     * CreateResponse constructor.
     *
     * Sets $success default value
     */
    public function __construct()
    {
        $this->success = false;
    }

    /**
     * Returns result of service processing
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Sets result of service processing
     *
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * Return user associated with created profile
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Sets user associated with created profile
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}