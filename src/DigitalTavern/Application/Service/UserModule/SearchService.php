<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\SearchResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SearchService
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class SearchService extends AbstractService implements ServiceInterface
{
    /**
     * Searches for available users
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $users = $this->getEntityManager()->getRepository('Entity:User')->findByQuery(
            $request->getIgn(),
            $request->getOffset(),
            $request->getLimit()
        );

        $response = new SearchResponse();

        if(!empty($users)){
            $response->setUsers($users);
        }

        return $response;
    }
}