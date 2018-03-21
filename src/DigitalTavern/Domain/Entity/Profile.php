<?php

namespace DigitalTavern\Domain\Entity;

/**
 * Profile entity
 *
 * @Entity(repositoryClass="DigitalTavern\Application\Repository\ProfileRepository")
 * @Table(name="profile")
 *
 * @package DigitalTavern\Domain\Entity
 */
class Profile
{
    /**
     * Profile ID
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int $id
     */
    private $id;

    /**
     * User associated with profile
     *
     * @OneToOne(targetEntity="User", mappedBy="profile")
     * @var User
     */
    private $user;

    /**
     * Returns profile ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Returns user associated with profile
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Sets user associated with profile
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}