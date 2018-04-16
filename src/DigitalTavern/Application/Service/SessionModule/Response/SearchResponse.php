<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SearchResponse
 *
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class SearchResponse implements ServiceResponseInterface
{
    /**
     * Public sessions
     *
     * @var array
     */
    private $sessions;

    /**
     * GetPublicResponse constructor.
     *
     * Initialises $sessions array
     */
    public function __construct()
    {
        $this->sessions = [];
    }

    /**
     * Returns public sessions
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }

    /**
     * Sets public sessions
     *
     * @param array $sessions
     */
    public function setSessions(array $sessions): void
    {
        $this->sessions = $sessions;
    }
}