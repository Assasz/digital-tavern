<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use DigitalTavern\Domain\Entity\Session;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetResponse
 *
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class GetResponse implements ServiceResponseInterface
{
    /**
     * Requested session
     *
     * @var null|Session
     */
    private $session;

    /**
     * Returns session
     *
     * @return null|Session
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * Sets session
     *
     * @param Session $session
     */
    public function setSession(Session $session): void
    {
        $this->session = $session;
    }
}