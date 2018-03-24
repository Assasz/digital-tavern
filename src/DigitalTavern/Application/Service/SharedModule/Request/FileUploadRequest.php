<?php

namespace DigitalTavern\Application\Service\SharedModule\Request;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class FileUploadRequest
 *
 * @package DigitalTavern\Application\Service\SharedModule\Request
 */
class FileUploadRequest implements ServiceRequestInterface
{
    /**
     * Uploaded file
     *
     * @var UploadedFile
     */
    private $file;

    /**
     * Gets uploaded file
     *
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * Sets uploaded file
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }
}