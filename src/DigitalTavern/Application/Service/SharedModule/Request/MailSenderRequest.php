<?php

namespace DigitalTavern\Application\Service\SharedModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class MailSenderRequest
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\SharedModule\Request
 */
class MailSenderRequest implements ServiceRequestInterface
{
    /**
     * Mail subject
     *
     * @var string
     */
    private $subject;

    /**
     * Mail body
     *
     * @var string
     */
    private $body;

    /**
     * Set of senders
     *
     * @var array
     */
    private $sender;

    /**
     * Set of receivers
     *
     * @var array
     */
    private $receivers;

    /**
     * MailSenderRequest constructor.
     *
     * Initialises arrays
     */
    public function __construct()
    {
        $this->sender = [];
        $this->receivers = [];
    }

    /**
     * Returns mail subject
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Sets mail subject
     *
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * Returns mail body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Sets mail body
     *
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * Returns set of senders
     *
     * @return array
     */
    public function getSender(): array
    {
        return $this->sender;
    }

    /**
     * Sets set of senders
     *
     * @param array $sender
     */
    public function setSender(array $sender)
    {
        $this->sender = $sender;
    }

    /**
     * Returns set of receivers
     *
     * @return array
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    /**
     * Sets set of receivers
     *
     * @param array $receivers
     */
    public function setReceivers(array $receivers)
    {
        $this->receivers = $receivers;
    }
}