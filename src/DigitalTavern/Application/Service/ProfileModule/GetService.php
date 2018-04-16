<?php

namespace DigitalTavern\Application\Service\ProfileModule;

use DigitalTavern\Application\Service\ProfileModule\Response\GetResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class GetPublicService
 *
 * @package DigitalTavern\Application\Service\ProfileModule
 */
class GetService extends AbstractService implements ServiceInterface
{
    /**
     * Returns user profile
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUserId());
        $profile = $this->getEntityManager()->getRepository('Entity:Profile')->findOneByUser($user);

        $response = new GetResponse();

        if(!empty($profile)){
            $response->setProfile($profile);
            $response->setSuccess(true);
        }

        return $response;
    }
}