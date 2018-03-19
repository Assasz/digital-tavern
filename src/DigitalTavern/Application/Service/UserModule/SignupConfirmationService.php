<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\SignupConfirmationResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SignupConfirmationService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class SignupConfirmationService extends AbstractService implements ServiceInterface
{
    /**
     * Activates user account
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $entityManager = $this->getEntityManager();
        $user = $entityManager->getRepository('Entity:User')->findOneByConfirmationToken($request->getToken());

        $response = new SignupConfirmationResponse();

        if($user !== null){
            if($user->getEnabled() == '1'){
                $response->setAlreadyActive(true);
                return $response;
            }

            $user->setEnabled('1');
            $entityManager->flush();

            $response->setSuccess(true);
        }

        return $response;
    }
}