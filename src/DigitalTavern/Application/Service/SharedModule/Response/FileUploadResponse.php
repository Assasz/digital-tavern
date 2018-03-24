<?php

namespace DigitalTavern\Application\Service\SharedModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class FileUploadResponse
 *
 * @package DigitalTavern\Application\Service\SharedModule\Response
 */
class FileUploadResponse implements ServiceResponseInterface
{
    /**
     * Path of uploaded file
     *
     * @var string
     */
    private $filePath;

    /**
     * Returns path of uploaded file
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * Sets path of uploaded file
     *
     * @param string $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }
}