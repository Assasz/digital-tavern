<?php

namespace DigitalTavern\Application\Service\ProfileModule;

use DigitalTavern\Application\Service\ProfileModule\Response\CreateResponse;
use DigitalTavern\Application\Service\SharedModule\Request\FileUploadRequest;
use DigitalTavern\Domain\Entity\Profile;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class CreateService
 *
 * @package DigitalTavern\Application\Service\ProfileModule
 */
class CreateService extends AbstractService implements ServiceInterface
{
    /**
     * Creates profile
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $profile = new Profile();
        $profile->setIgn($request->getIgn());

        $user = $this->getEntityManager()->getRepository('Entity:User')->find($request->getUserId());
        $profile->setUser($user);

        $optionalProperties = ['Avatar', 'Race', 'Origin', 'Age', 'Occupation', 'Full'];

        foreach ($optionalProperties as $property){
            $getter = 'get'.$property;
            $setter = 'set'.$property;

            if(!empty($request->{$getter}())){
                $profile->{$setter}($request->{$getter}());
            }
        }

        $errors = $this->getValidator()->validate($profile);
        $response = new CreateResponse();

        if(count($errors) < 1){
            if(!empty($request->getAvatar())){
                $uploadRequest = new FileUploadRequest();
                $uploadRequest->setFile($request->getAvatar());

                $uploadService = $this->getContainer()->get('shared.file_upload');
                $uploadResponse = $uploadService->process($uploadRequest);

                $profile->setAvatarPath($uploadResponse->getFilePath());
                $profile->setAvatar();
            }

            $user->setProfile($profile);

            $this->getEntityManager()->persist($profile);
            $this->getEntityManager()->flush();

            $response->setSuccess(true);
            $response->setUser($user);
        }

        return $response;
    }
}