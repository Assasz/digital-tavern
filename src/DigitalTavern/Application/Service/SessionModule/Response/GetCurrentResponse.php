<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use DigitalTavern\Domain\Entity\Session;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetCurrentResponse
 *
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class GetCurrentResponse implements ServiceResponseInterface
{
    /**
     * Current session that user is connected to
     *
     * @var Session $session
     */
    private $session;

    /**
     * Returns current session
     *
     * @return null|Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Sets current session
     *
     * @param Session $session
     */
    public function setSession(Session $session): void
    {
        $this->session = $session;
    }
}