<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\GetResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class GetService extends AbstractService implements ServiceInterface
{
    /**
     * Gets session by channel
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $session = $this->getEntityManager()->getRepository('Entity:Session')->findOneByChannel($request->getChannel());

        $response = new GetResponse();

        if(!empty($session)){
            $response->setSession($session);
        }

        return $response;
    }
}