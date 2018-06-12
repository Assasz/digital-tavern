<?php

namespace DigitalTavern\Application\Service\ProfileModule;

use DigitalTavern\Application\Service\ProfileModule\Response\EditResponse;
use DigitalTavern\Application\Service\SharedModule\Request\FileUploadRequest;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class EditService
 *
 * @package DigitalTavern\Application\Service\ProfileModule
 */
class EditService extends AbstractService implements ServiceInterface
{
    /**
     * Edits user profile
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $profile = $request->getProfile();
        $profile->setIgn($request->getIgn());

        $properties = ['Race', 'Origin', 'Age', 'Occupation', 'Full'];

        foreach ($properties as $property){
            $getter = 'get'.$property;
            $setter = 'set'.$property;

            $profile->{$setter}($request->{$getter}());
        }

        if(!empty($request->getAvatar())){
            $profile->setAvatar($request->getAvatar());
        }

        $errors = $this->getValidator()->validate($profile);
        $response = new EditResponse();

        if(count($errors) < 1){
            if(!empty($request->getAvatar())){
                $uploadRequest = new FileUploadRequest();
                $uploadRequest->setFile($request->getAvatar());

                $uploadService = $this->getContainer()->get('shared.file_upload');
                $uploadResponse = $uploadService->process($uploadRequest);

                $profile->setAvatarPath($uploadResponse->getFilePath());
                $profile->setAvatar();
            }

            $this->getEntityManager()->flush();

            $response->setSuccess(true);
        }

        return $response;
    }
}