<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\ChannelCheckResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class ChannelCheckService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class ChannelCheckService extends AbstractService implements ServiceInterface
{
    /**
     * Checks if channel that user is connected to is still active, if not, removes connection
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUserId());
        $session = $this->getEntityManager()->getRepository('Entity:Session')->find($user->getCurrentSession());

        $response = new ChannelCheckResponse();

        if(empty($session)){
            $user->setCurrentSession();
            $this->getEntityManager()->flush();

            $response->setUser($user);
        }

        return $response;
    }
}