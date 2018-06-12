<?php

namespace DigitalTavern\Application\Service\ProfileModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class EditResponse
 *
 * @package DigitalTavern\Application\Service\ProfileModule\Response
 */
class EditResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

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
}