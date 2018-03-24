<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\EmailCheckResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class EmailCheckService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class EmailCheckService extends AbstractService implements ServiceInterface
{
    /**
     * Checks if email address is already taken by another user
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $entityManager = $this->getEntityManager();
        $users = $entityManager->getRepository('Entity:User')->findByEmail($request->getEmail());

        $response = new EmailCheckResponse();

        if(count($users) < 1){
            $response->setSuccess(true);
        }

        return $response;
    }
}