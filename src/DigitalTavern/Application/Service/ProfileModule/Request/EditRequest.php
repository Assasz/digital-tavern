<?php

namespace DigitalTavern\Application\Service\ProfileModule\Request;

use DigitalTavern\Domain\Entity\Profile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class EditRequest
 *
 * @package DigitalTavern\Application\Service\ProfileModule\Request
 */
class EditRequest implements ServiceRequestInterface
{
    /**
     * User profile
     *
     * @var Profile
     */
    private $profile;

    /**
     * Profile In Game Name
     *
     * @var string
     */
    private $ign;

    /**
     * Profile avatar file
     *
     * @var UploadedFile
     */
    private $avatar;

    /**
     * Profile race
     *
     * @var string
     */
    private $race;

    /**
     * Profile origin
     *
     * @var string
     */
    private $origin;

    /**
     * Profile age
     *
     * @var string
     */
    private $age;

    /**
     * Profile occupation
     *
     * @var string
     */
    private $occupation;

    /**
     * Full profile
     *
     * @var string
     */
    private $full;

    /**
     * Returns user profile
     *
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * Sets user profile
     *
     * @param Profile $profile
     */
    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
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
     * Returns profile avatar file
     *
     * @return null|UploadedFile
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Sets profile avatar file
     *
     * @param null|UploadedFile $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * Returns profile race
     *
     * @return string
     */
    public function getRace(): string
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
     * @return string
     */
    public function getOrigin(): string
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
     * @return string
     */
    public function getAge(): string
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
     * @return string
     */
    public function getOccupation(): string
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
     * @return string
     */
    public function getFull(): string
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