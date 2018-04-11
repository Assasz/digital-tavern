<?php

namespace DigitalTavern\Domain\Entity;

use Symfony\Component\HttpFoundation\File\File;

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
     * @OneToOne(targetEntity="User", inversedBy="profile")
     * @JoinColumn(name="userId", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * Profile In Game Name
     *
     * @Column(type="string", length=255)
     * @var string
     */
    private $ign;

    /**
     * Profile avatar file
     *
     * @var File
     */
    private $avatar;

    /**
     * Profile avatar path
     *
     * @Column(name="avatar", type="string", length=255, nullable=true)
     * @var string
     */
    private $avatarPath;

    /**
     * Profile race
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $race;

    /**
     * Profile origin
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $origin;

    /**
     * Profile age
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $age;

    /**
     * Profile occupation
     *
     * @Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $occupation;

    /**
     * Full profile
     *
     * @Column(type="text", nullable=true)
     * @var string
     */
    private $full;

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

    /**
     * Returns profile IGN
     *
     * @return string
     */
    public function getIgn(): string
    {
        return $this->ign;
    }

    /**
     * Sets profile IGN
     *
     * @param string $ign
     */
    public function setIgn(string $ign): void
    {
        $this->ign = $ign;
    }

    /**
     * Return profile avatar file
     *
     * @return File
     */
    public function getAvatar(): File
    {
        return $this->avatar;
    }

    /**
     * Sets profile avatar file
     *
     * @param File $avatar
     */
    public function setAvatar(File $avatar = null): void
    {
        $this->avatar = $avatar;
    }

    /**
     * Returns profile avatar path
     *
     * @return null|string
     */
    public function getAvatarPath()
    {
        return $this->avatarPath;
    }

    /**
     * Sets profile avatar path
     *
     * @param string $avatar
     */
    public function setAvatarPath(string $avatar): void
    {
        $this->avatarPath = $avatar;
    }

    /**
     * Returns profile race
     *
     * @return null|string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Sets profile race
     *
     * @param string $race
     */
    public function setRace(string $race): void
    {
        $this->race = $race;
    }

    /**
     * Returns profile origin
     *
     * @return null|string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets profile origin
     *
     * @param string $origin
     */
    public function setOrigin(string $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * Returns profile age
     *
     * @return null|string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Sets profile age
     *
     * @param string $age
     */
    public function setAge(string $age): void
    {
        $this->age = $age;
    }

    /**
     * Returns profile occupation
     *
     * @return null|string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Sets profile occupation
     *
     * @param string $occupation
     */
    public function setOccupation(string $occupation): void
    {
        $this->occupation = $occupation;
    }

    /**
     * Returns full profile
     *
     * @return null|string
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * Sets full profile
     *
     * @param string $full
     */
    public function setFull(string $full): void
    {
        $this->full = $full;
    }
}