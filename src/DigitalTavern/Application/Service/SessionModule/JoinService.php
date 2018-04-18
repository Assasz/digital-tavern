<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\JoinResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class JoinService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class JoinService extends AbstractService implements ServiceInterface
{
    /**
     * Joins user to session
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $session = $this->getEntityManager()->getRepository('Entity:Session')->findOneByChannel($request->getChannel());

        $response = new JoinResponse();

        if(!empty($session)){
            $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUserId());

            if(!$session->getPlayers()->contains($user)){
                $session->addPlayer($user);
            }

            $user->setCurrentChannel($request->getChannel());
            $this->getEntityManager()->flush();

            $response->setSuccess(true);
            $response->setSession($session);
            $response->setUser($user);
        }

        return $response;
    }
}