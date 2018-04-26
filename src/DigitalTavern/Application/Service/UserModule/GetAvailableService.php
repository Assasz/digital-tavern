<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\GetAvailableResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetAvailableService
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class GetAvailableService extends AbstractService implements ServiceInterface
{
    /**
     * Gets available users
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $users = $this->getEntityManager()->getRepository('Entity:User')->findAvailable($request->getOffset(), $request->getLimit());

        $response = new GetAvailableResponse();

        if(!empty($users)){
            $response->setUsers($users);
        }

        return $response;
    }
}