<?php
namespace DigitalTavern\Ports\Socket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * Class ChatSocket
 *
 * Manages chat socket which includes sessions and private conversations
 *
 * @package DigitalTavern\Ports\Socket
 */
class ChatSocket implements MessageComponentInterface
{
    /**
     * Executed on open WebSockets event
     *
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
    }

    /**
     * Executed on message WebSockets event
     *
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
    }

    /**
     * Executed on close WebSockets event
     *
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
    }

    /**
     * Executed on error WebSockets event
     *
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}