<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class RenderMessageRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class RenderMessageRequest implements ServiceRequestInterface
{
    /**
     * Message content
     *
     * @var string
     */
    private $content;

    /**
     * Message author, empty if message is of notification type
     *
     * @var null|User
     */
    private $user;

    /**
     * Session channel
     *
     * @var string
     */
    private $channel;

    /**
     * Returns message content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Sets message content
     *
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Returns message author
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Sets message author
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Returns channel
     *
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * Sets channel
     *
     * @param string $channel
     */
    public function setChannel(string $channel): void
    {
        $this->channel = $channel;
    }
}