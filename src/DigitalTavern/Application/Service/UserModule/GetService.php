<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\GetResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetService
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class GetService extends AbstractService implements ServiceInterface
{
    /**
     * Gets user
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUserId());

        $response = new GetResponse();

        if(!empty($user)){
            $response->setUser($user);
        }

        return $response;
    }
}