<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Yggdrasil\Core\Service\ServiceRequestInterface;

class CreateRequest implements ServiceRequestInterface
{
    /**
     * Session name
     *
     * @var string $name
     */
    private $name;

    /**
     * Session short description
     *
     * @var string $description
     */
    private $description;

    /**
     * Session plot background
     *
     * @var string $plotBackground
     */
    private $plotBackground;

    /**
     * Session plot location
     *
     * @var string $location
     */
    private $location;

    /**
     * Session token
     *
     * @var string $token
     */
    private $token;

    /**
     * Session password
     *
     * @var string $password
     */
    private $password;

    /**
     * Session players limit
     *
     * @var int $playersLimit
     */
    private $playersLimit;

    /**
     * Session image file
     *
     * @var UploadedFile $image
     */
    private $image;

    /**
     * Session host ID
     *
     * @var int $hostId
     */
    private $hostId;

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
     * Returns session token
     *
     * @return string
     */
    public function getToken(): string
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
     * @return string
     */
    public function getPassword(): string
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
     * @return int
     */
    public function getPlayersLimit(): int
    {
        return $this->playersLimit;
    }

    /**
     * Sets players limit
     *
     * @param string $playersLimit
     */
    public function setPlayersLimit(string $playersLimit): void
    {
        $this->playersLimit = (int) $playersLimit;
    }

    /**
     * Returns session image file
     *
     * @return null|UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets session image file
     *
     * @param null|UploadedFile $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * Returns session host ID
     *
     * @return int
     */
    public function getHostId(): int
    {
        return $this->hostId;
    }

    /**
     * Sets session host ID
     *
     * @param int $hostId
     */
    public function setHostId(int $hostId): void
    {
        $this->hostId = $hostId;
    }
}