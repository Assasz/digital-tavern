<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\GetPublicResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetPublicService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class GetPublicService extends AbstractService implements ServiceInterface
{
    /**
     * Gets public sessions
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $sessions = $this->getEntityManager()->getRepository('Entity:Session')->findPublic($request->getOffset(), $request->getLimit());

        $response = new GetPublicResponse();

        if(count($sessions) > 0){
            $response->setSessions($sessions);
        }

        return $response;
    }
}