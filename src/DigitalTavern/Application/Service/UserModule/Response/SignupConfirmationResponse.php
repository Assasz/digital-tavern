<?php

namespace DigitalTavern\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SignupConfirmationResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Response
 */
class SignupConfirmationResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * Activation status of user account
     *
     * @var bool
     */
    private $alreadyActive;

    /**
     * SignupConfirmationResponse constructor.
     *
     * Sets home values
     */
    public function __construct()
    {
        $this->success = false;
        $this->alreadyActive = false;
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
     * Returns activation status of user account
     *
     * @return bool
     */
    public function isAlreadyActive(): bool
    {
        return $this->alreadyActive;
    }

    /**
     * Sets activation status of user account
     *
     * @param bool $alreadyActive
     */
    public function setAlreadyActive(bool $alreadyActive): void
    {
        $this->alreadyActive = $alreadyActive;
    }
}