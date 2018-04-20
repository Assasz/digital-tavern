<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\GetPlayersResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetPlayersService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class GetPlayersService extends AbstractService implements ServiceInterface
{
    /**
     * Gets session players
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $session = $this->getEntityManager()->getRepository('Entity:Session')->findOneByChannel($request->getChannel());

        $response = new GetPlayersResponse();

        if(!empty($session)){
            $response->setPlayers($session->getPlayers()->toArray());
        }

        return $response;
    }
}