<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\RenderMessageResponse;
use DigitalTavern\Domain\Entity\SessionMessage;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class RenderMessageService
 *
 * @package DigitalTavern\Application\Service\SessionModule
 */
class RenderMessageService extends AbstractService implements ServiceInterface
{
    /**
     * Saves and renders session message
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $message = new SessionMessage();
        $message->setContent($request->getContent());

        if(!empty($request->getUser())){
            $message->setUser($request->getUser());
        }

        $errors = $this->getValidator()->validate($message);

        $response = new RenderMessageResponse();

        if(count($errors) < 1){
            $session = $this->getEntityManager()->getRepository('Entity:Session')->findOneByChannel($request->getChannel());
            $session->addMessage($message);
            $message->setSession($session);

            $this->getEntityManager()->persist($message);
            $this->getEntityManager()->flush();

            $template = $this->getTemplateEngine()->render('session/_message.html.twig', [
                'message' => $message
            ]);

            $response->setMessageTemplate($template);
        }

        return $response;
    }
}