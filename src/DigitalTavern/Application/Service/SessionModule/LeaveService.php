<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\LeaveResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class LeaveService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class LeaveService extends AbstractService implements ServiceInterface
{
    /**
     * Removes user from session or removes session
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
        $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUser());

        $response = new LeaveResponse();

        if(!empty($session)){
            if($user == $session->getHost() || $user->getRole() == 'super game master'){
                foreach ($session->getPlayers()->toArray() as $player){
                    $player->setCurrentSession();
                }

                foreach ($session->getMessages()->toArray() as $message){
                    $this->getEntityManager()->remove($message);
                }

                $this->getEntityManager()->remove($session);
            } else {
                $session->removePlayer($user);
                $user->setCurrentSession();
            }

            $this->getEntityManager()->flush();

            $response->setUser($user);
        }

        return $response;
    }
}