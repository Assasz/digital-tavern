<?php

namespace DigitalTavern\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class EmailCheckerResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Response
 */
class EmailCheckerResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * EmailCheckerResponse constructor.
     *
     * Sets home value of $success
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
}