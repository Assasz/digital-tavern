<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class SignupConfirmationRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class SignupConfirmationRequest implements ServiceRequestInterface
{
    /**
     * Confirmation token
     *
     * @var string
     */
    private $token;

    /**
     * Returns confirmation token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Sets confirmation token
     *
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}