<?php

namespace DigitalTavern\Application\Service\ProfileModule\Response;

use DigitalTavern\Domain\Entity\Profile;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetResponse
 *
 * @package DigitalTavern\Application\Service\ProfileModule\Response
 */
class GetResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * User profile
     *
     * @var Profile
     */
    private $profile;

    /**
     * GetResponse constructor.
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
     * Returns user profile
     *
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * Sets user profile
     *
     * @param Profile $profile
     */
    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }
}