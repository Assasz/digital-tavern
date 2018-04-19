<?php

namespace DigitalTavern\Domain\Entity;

/**
 * User entity
 *
 * @Entity(repositoryClass="DigitalTavern\Application\Repository\UserRepository")
 * @Table(name="`user`")
 *
 * @package DigitalTavern\Domain\Entity
 */
class User
{
    /**
     * User ID
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    private $id;

    /**
     * User email address
     *
     * @Column(type="string", length=255, unique=true)
     * @var string $email
     */
    private $email;

    /**
     * User password
     *
     * @Column(type="string", length=255)
     * @var string $password
     */
    private $password;

    /**
     * User remember token
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string $rememberToken
     */
    private $rememberToken;

    /**
     * User remember identifier
     *
     * @Column(type="string", length=255)
     * @var string $rememberIdentifier
     */
    private $rememberIdentifier;

    /**
     * User enabled status
     *
     * @Column(type="string", columnDefinition="ENUM('0', '1')")
     * @var string $enabled
     */
    private $enabled;

    /**
     * User confirmation token
     *
     * @Column(type="string", length=255)
     * @var string $confirmationToken
     */
    private $confirmationToken;

    /**
     * User last activity date
     *
     * @Column(type="datetime", nullable=true)
     * @var \DateTime $lastActivityDate
     */
    private $lastActivityDate;

    /**
     * User role-playing profile
     *
     * @OneToOne(targetEntity="Profile", inversedBy="user")
     * @JoinColumn(name="profileId", referencedColumnName="id", nullable=true)
     * @var Profile $profile
     */
    private $profile;

    /**
     * User role
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string $role
     */
    private $role;

    /**
     * Current session channel that user is connected to
     *
     * @ManyToOne(targetEntity="Session", inversedBy="players")
     * @JoinColumn(name="currentSession", referencedColumnName="id", nullable=true)
     * @var Session $currentSession
     */
    private $currentSession;

    /**
     * User constructor.
     *
     * Sets default values
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->rememberIdentifier = bin2hex(random_bytes(32));
        $this->enabled = '0';
        $this->confirmationToken = bin2hex(random_bytes(32));
    }

    /**
     * Returns user ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Returns user email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets user email
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Returns user password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets user password
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Returns user remember token
     *
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    /**
     * Sets user remember token
     *
     * @param string $token
     */
    public function setRememberToken(string $token): void
    {
        $this->rememberToken = $token;
    }

    /**
     * Returns user remember identifier
     *
     * @return string
     */
    public function getRememberIdentifier(): string
    {
        return $this->rememberIdentifier;
    }

    /**
     * Sets user remember identifier
     *
     * @param string $rememberIdentifier
     */
    public function setRememberIdentifier(string $rememberIdentifier): void
    {
        $this->rememberIdentifier = $rememberIdentifier;
    }

    /**
     * Returns user enabled status
     *
     * @return string
     */
    public function getEnabled(): string
    {
        return $this->enabled;
    }

    /**
     * Sets user enabled status
     *
     * @param string $enabled
     */
    public function setEnabled(string $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * Returns user confirmation token
     *
     * @return string
     */
    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }

    /**
     * Sets user confirmation token
     *
     * @param string $confirmationToken
     */
    public function setConfirmationToken(string $confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * Returns user last activity date
     *
     * @return \DateTime
     */
    public function getLastActivityDate(): \DateTime
    {
        return $this->lastActivityDate;
    }

    /**
     * Sets user last activity date
     *
     * @param \DateTime $date
     */
    public function setLastActivityDate(\DateTime $date): void
    {
        $this->lastActivityDate = $date;
    }

    /**
     * Returns user role-playing profile
     *
     * @return null|Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Sets user role-playing profile
     *
     * @param Profile $profile
     */
    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }

    /**
     * Returns user role
     *
     * @return null|string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Sets user role
     *
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Returns current session
     *
     * @return null|Session
     */
    public function getCurrentSession()
    {
        return $this->currentSession;
    }

    /**
     * Sets current session
     *
     * @param null|Session $currentSession
     */
    public function setCurrentSession(Session $currentSession = null): void
    {
        $this->currentSession = $currentSession;
    }
}