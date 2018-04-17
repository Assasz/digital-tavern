<?php

namespace DigitalTavern\Application\Service\SessionModule;

use DigitalTavern\Application\Service\SessionModule\Response\CreateResponse;
use DigitalTavern\Application\Service\SharedModule\Request\FileUploadRequest;
use DigitalTavern\Domain\Entity\Session;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class CreateService extends AbstractService implements ServiceInterface
{
    /**
     * Creates session
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $session = new Session();

        $requiredProperties = ['Name', 'Description', 'PlotBackground', 'Location'];
        $optionalProperties = ['Token', 'Password', 'PlayersLimit', 'Image'];

        foreach ($requiredProperties as $property){
            $getter = 'get'.$property;
            $setter = 'set'.$property;

            $session->{$setter}($request->{$getter}());
        }

        foreach ($optionalProperties as $property){
            $getter = 'get'.$property;
            $setter = 'set'.$property;

            if(!empty($request->{$getter}())){
                $session->{$setter}($request->{$getter}());
            }
        }

        $response = new CreateResponse();

        $errors = $this->getValidator()->validate($session);

        if(count($errors) < 1){
            $response->setSuccess(true);
            $response->setChannel($session->getChannel());

            if(!empty($session->getPassword())){
                $hash = password_hash($session->getPassword(), PASSWORD_BCRYPT);
                $session->setPassword($hash);
            }

            if(!empty($session->getImage())){
                $uploadRequest = new FileUploadRequest();
                $uploadRequest->setFile($session->getImage());

                $uploadService = $this->getContainer()->get('shared.file_upload');
                $uploadResponse = $uploadService->process($uploadRequest);

                $session->setImagePath($uploadResponse->getFilePath());
                $session->setImage();
            }

            $host = $this->getEntityManager()->getRepository('Entity:User')->find($request->getHostId());

            $session->setHost($host);
            $session->addPlayer($host);

            $this->getEntityManager()->persist($session);
            $this->getEntityManager()->flush();
        }

        return $response;
    }
}