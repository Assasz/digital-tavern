<?php

namespace DigitalTavern\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Session entity
 *
 * @Entity(repositoryClass="DigitalTavern\Application\Repository\SessionRepository")
 * @Table(name="session")
 *
 * @package DigitalTavern\Domain\Entity
 */
class Session
{
    /**
     * Session ID
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    private $id;

    /**
     * Session name
     *
     * @Column(type="string", length=255)
     * @var string $name
     */
    private $name;

    /**
     * Session short description
     *
     * @Column(type="text")
     * @var string $description
     */
    private $description;

    /**
     * Session plot background
     *
     * @Column(type="text")
     * @var string $plotBackground
     */
    private $plotBackground;

    /**
     * Session plot location
     *
     * @Column(type="string", length=255)
     * @var string $location
     */
    private $location;

    /**
     * Session image file
     *
     * @var File $image
     */
    private $image;

    /**
     * Session image path
     *
     * @Column(name="image", type="string", length=255, nullable=true)
     * @var string $imagePath
     */
    private $imagePath;

    /**
     * Session token
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string $token
     */
    private $token;

    /**
     * Session password, makes session private
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string $password
     */
    private $password;

    /**
     * Session players limit
     *
     * @Column(type="integer", nullable=true)
     * @var int $playersLimit
     */
    private $playersLimit;

    /**
     * Session players
     *
     * @ManyToMany(targetEntity="User")
     * @JoinTable(name="session_player",
     *      joinColumns={@JoinColumn(name="sessionId", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="userId", referencedColumnName="id", unique=true)}
     *      )
     * @var ArrayCollection $players
     */
    private $players;

    /**
     * Session host, game master
     *
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="hostId", referencedColumnName="id")
     * @var User $host
     */
    private $host;

    /**
     * Session messages
     *
     * @OneToMany(targetEntity="SessionMessage", mappedBy="session")
     * @var ArrayCollection $messages
     */
    private $messages;

    /**
     * Session create date
     *
     * @Column(type="datetime")
     * @var \DateTime $createDate
     */
    private $createDate;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->createDate = new \DateTime('now');
    }

    /**
     * Returns session ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Returns session name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets session name
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns session description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets session description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns session plot background
     *
     * @return string
     */
    public function getPlotBackground(): string
    {
        return $this->plotBackground;
    }

    /**
     * Sets session plot background
     *
     * @param string $plotBackground
     */
    public function setPlotBackground(string $plotBackground): void
    {
        $this->plotBackground = $plotBackground;
    }

    /**
     * Returns session plot location
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Sets session plot location
     *
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * Returns session image file
     *
     * @return null|File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets session image file
     *
     * @param File $image
     */
    public function setImage(File $image = null): void
    {
        $this->image = $image;
    }

    /**
     * Returns session image path
     *
     * @return null|string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Sets session image path
     *
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Returns session token
     *
     * @return null|string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Sets session token
     *
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * Returns session password
     *
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets session password
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Returns session players limit
     *
     * @return null|int
     */
    public function getPlayersLimit()
    {
        return $this->playersLimit;
    }

    /**
     * Sets session players limit
     *
     * @param int $playersLimit
     */
    public function setPlayersLimit(int $playersLimit): void
    {
        $this->playersLimit = $playersLimit;
    }

    /**
     * Return session players
     *
     * @return ArrayCollection
     */
    public function getPlayers(): ArrayCollection
    {
        return $this->players;
    }

    /**
     * Adds new player to session
     *
     * @param User $player
     */
    public function addPlayer(User $player): void
    {
        $this->players[] = $player;
    }

    /**
     * Removes player from session
     *
     * @param User $player
     */
    public function removePlayer(User $player): void
    {
        $this->players->removeElement($player);
    }

    /**
     * Returns session host
     *
     * @return User
     */
    public function getHost(): User
    {
        return $this->host;
    }

    /**
     * Sets session host
     *
     * @param User $host
     */
    public function setHost(User $host): void
    {
        $this->host = $host;
    }

    /**
     * Returns session messages
     *
     * @return ArrayCollection
     */
    public function getMessages(): ArrayCollection
    {
        return $this->messages;
    }

    /**
     * Adds new message to session
     *
     * @param SessionMessage $message
     */
    public function addMessage(SessionMessage $message): void
    {
        $this->messages[] = $message;
    }

    /**
     * Removes message from session
     *
     * @param SessionMessage $message
     */
    public function removeMessage(SessionMessage $message): void
    {
        $this->messages->removeElement($message);
    }

    /**
     * Returns session create date
     *
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    /**
     * Sets session create date
     *
     * @param \DateTime $createDate
     */
    public function setCreateDate(\DateTime $createDate): void
    {
        $this->createDate = $createDate;
    }
}