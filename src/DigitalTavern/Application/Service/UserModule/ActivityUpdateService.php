<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\ActivityUpdateResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class ActivityUpdateService
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class ActivityUpdateService extends AbstractService implements ServiceInterface
{
    /**
     * Updates user last activity date
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
        $user->setLastActivityDate(new \DateTime('now'));

        $this->getEntityManager()->flush();

        $response = new ActivityUpdateResponse();

        return $response;
    }
}