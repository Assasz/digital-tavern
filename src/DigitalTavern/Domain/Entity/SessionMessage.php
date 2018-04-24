<?php

namespace DigitalTavern\Domain\Entity;

/**
 * SessionMessage entity
 *
 * @Entity(repositoryClass="DigitalTavern\Application\Repository\SessionMessageRepository")
 * @Table(name="session_message")
 *
 * @package DigitalTavern\Domain\Entity
 */
class SessionMessage
{
    /**
     * Session message ID
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    private $id;

    /**
     * Associated session
     *
     * @ManyToOne(targetEntity="Session", inversedBy="messages")
     * @JoinColumn(name="sessionId", referencedColumnName="id")
     * @var Session $session
     */
    private $session;

    /**
     * Session message author, empty if message is of notification type
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="userId", referencedColumnName="id", nullable=true)
     * @var null|User $user
     */
    private $user;

    /**
     * Session message content
     *
     * @Column(type="text")
     * @var string $content
     */
    private $content;

    /**
     * Session message create date
     *
     * @Column(type="datetime")
     * @var \DateTime $createDate
     */
    private $createDate;

    /**
     * SessionMessage constructor.
     */
    public function __construct()
    {
        $this->createDate = new \DateTime('now');
    }

    /**
     * Returns session message ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Return session message author
     *
     * @return null|User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Sets session message author
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Returns associated session
     *
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * Sets associated session
     *
     * @param Session $session
     */
    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    /**
     * Returns session message content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Sets session message content
     *
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Returns session message create date
     *
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    /**
     * Sets session message create date
     *
     * @param \DateTime $createDate
     */
    public function setCreateDate(\DateTime $createDate): void
    {
        $this->createDate = $createDate;
    }
}