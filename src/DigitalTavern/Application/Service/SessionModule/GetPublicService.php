<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\GetPublicResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class GetPublicService extends AbstractService implements ServiceInterface
{
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $sessions = $this->getEntityManager()->getRepository('Entity:Session')->findPublic($request->getOffset(), $request->getLimit());

        $response = new GetPublicResponse();

        if(count($sessions) > 0){
            $response->setSuccess(true);
            $response->setSessions($sessions);
        }

        return $response;
    }
}