<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\EmailCheckerResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class EmailCheckerService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class EmailCheckerService extends AbstractService implements ServiceInterface
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

        $response = new EmailCheckerResponse();

        if(count($users) < 1){
            $response->setSuccess(true);
        }

        return $response;
    }
}