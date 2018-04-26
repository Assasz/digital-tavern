<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\SearchResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SearchService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class SearchService extends AbstractService implements ServiceInterface
{
    /**
     * Searches for sessions
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $repository = $this->getEntityManager()->getRepository('Entity:Session');
        $sessions = [];

        if(!empty($request->getQuery())) {
            if ($request->getType() === 'public') {
                $sessions = $repository->findPublicByQuery(
                    $request->getQuery(),
                    $request->getOffset(),
                    $request->getLimit()
                );
            } else {
                $sessions = $repository->findPrivate(
                    $request->getQuery(),
                    $request->getOffset(),
                    $request->getLimit()
                );
            }
        }

        $response = new SearchResponse();

        if(count($sessions) > 0){
            $response->setSessions($sessions);
        }

        return $response;
    }
}