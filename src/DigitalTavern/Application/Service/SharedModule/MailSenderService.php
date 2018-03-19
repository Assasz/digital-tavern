<?php

namespace DigitalTavern\Application\Service\SharedModule;

use DigitalTavern\Application\Service\SharedModule\Response\MailSenderResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class MailSenderService
 *
 * This is a part of built-in shared module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\SharedModule
 */
class MailSenderService extends AbstractService implements ServiceInterface
{
    /**
     * Sends mails
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $message = (new \Swift_Message($request->getSubject()))
            ->setFrom($request->getSender())
            ->setTo($request->getReceivers())
            ->setBody($request->getBody(), 'text/html');

        $response = new MailSenderResponse();

        if($this->getMailer()->send($message)){
            $response->setSuccess(true);
        }

        return $response;
    }
}