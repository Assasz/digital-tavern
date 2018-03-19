<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class RememberedAuthRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class RememberedAuthRequest implements ServiceRequestInterface
{
    /**
     * User remember token from cookie
     *
     * @var string
     */
    private $rememberToken;

    /**
     * User remember identifier from cookie
     *
     * @var string
     */
    private $rememberIdentifier;

    /**
     * Returns remember token
     *
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    /**
     * Sets remember token
     *
     * @param string $rememberToken
     */
    public function setRememberToken(string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    /**
     * Returns remember identifier
     *
     * @return string
     */
    public function getRememberIdentifier(): string
    {
        return $this->rememberIdentifier;
    }

    /**
     * Sets remember identifier
     *
     * @param string $rememberIdentifier
     */
    public function setRememberIdentifier(string $rememberIdentifier): void
    {
        $this->rememberIdentifier = $rememberIdentifier;
    }
}