<?php

namespace DigitalTavern\Application\Service\UserModule;

use DigitalTavern\Application\Service\UserModule\Response\UserAuthResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class AuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule
 */
class AuthService extends AbstractService implements ServiceInterface
{
    /**
     * Authenticates user
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
        $entityManager = $this->getEntityManager();
        $user = $entityManager->getRepository('Entity:User')->findOneByEmail($request->getEmail());

        $response = new UserAuthResponse();

        if($user !== null) {
            if (password_verify($request->getPassword(), $user->getPassword())) {
                $response->setSuccess(true);
                $response->setUser($user);

                if($user->getEnabled() == '0'){
                    $response->setEnabled(false);
                    return $response;
                }

                if($request->getRemember()){
                    $rememberToken = bin2hex(random_bytes(32));
                    $hash = password_hash($rememberToken, PASSWORD_BCRYPT);

                    $user->setRememberToken($hash);
                    $entityManager->flush();

                    $response->setRememberToken($rememberToken);
                }
            }
        }

        return $response;
    }
}