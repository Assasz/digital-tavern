<?php

namespace DigitalTavern\Application\Service\SharedModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class MailSenderResponse
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\SharedModule\Response
 */
class MailSenderResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * MailSenderResponse constructor.
     *
     * Sets home value for $success
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