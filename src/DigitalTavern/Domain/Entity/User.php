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
     * @Column(type="string", length=255)
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
     * User constructor.
     *
     * Sets home values
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
}