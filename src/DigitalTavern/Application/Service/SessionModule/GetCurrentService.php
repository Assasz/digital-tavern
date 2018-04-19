<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\GetCurrentResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetCurrentService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class GetCurrentService extends AbstractService implements ServiceInterface
{
    /**
     * Gets current session that user is connected to
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUserId());

        $response = new GetCurrentResponse();

        if(!empty($user->getCurrentSession())) {
            $session = $this->getEntityManager()->getRepository('Entity:Session')->find($user->getCurrentSession());

            if(!empty($session)){
                $response->setSession($session);
            }
        }

        return $response;
    }
}