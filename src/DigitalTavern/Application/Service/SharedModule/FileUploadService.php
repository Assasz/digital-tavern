<?php

namespace DigitalTavern\Application\Service\SharedModule;

use DigitalTavern\Application\Service\SharedModule\Response\FileUploadResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class FileUploadService
 *
 * @package DigitalTavern\Application\Service\SharedModule
 */
class FileUploadService extends AbstractService implements ServiceInterface
{
    /**
     * Uploads file
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $file = $request->getFile();
        $uploadTargetDir = dirname(__DIR__, 5).'/web/uploads/';

        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($uploadTargetDir, $fileName);

        $response = new FileUploadResponse();
        $response->setFilePath('uploads/'.$fileName);

        return $response;
    }
}