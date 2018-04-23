<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetPlayersResponse
 * 
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class GetPlayersResponse implements ServiceResponseInterface
{
    /**
     * Session players
     * 
     * @var null|array $players
     */
    private $players;

    /**
     * Returns session players
     * 
     * @return null|array
     */
    public function getPlayers(): ?array
    {
        return $this->players;
    }

    /**
     * Sets session players
     * 
     * @param array $players
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }
}