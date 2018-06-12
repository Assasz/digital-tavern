<?php

namespace DigitalTavern\Ports\Controller;

use DigitalTavern\Application\Service\ProfileModule\Request\CreateRequest;
use DigitalTavern\Application\Service\ProfileModule\Request\EditRequest;
use DigitalTavern\Application\Service\ProfileModule\Request\GetRequest;
use Symfony\Component\HttpFoundation\Session\Session;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Yggdrasil\Core\Form\FormHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class ProfileController
 *
 * @package DigitalTavern\Ports\Controller
 */
class ProfileController extends AbstractController
{

    /**
     * Profile index action, renders given user profile
     * Route: /profile/index/{userId}
     *
     * @param int $userId
     * @return string|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(int $userId)
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        if(empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Profile:create');
        }

        $request = new GetRequest();
        $request->setUserId($userId);

        $service = $this->getContainer()->get('profile.get');
        $response = $service->process($request);

        if(!$response->isSuccess()){
            $session = new Session();
            $session->getFlashBag()->set('warning', 'Profile you are looking for doesn\'t exist.');

            return $this->redirectToAction('Session:index');
        }

        return $this->render('profile/index.html.twig', [
            'profile' => $response->getProfile()
        ]);
    }

    /**
     * Profile create action, executed with user first sign in
     * Route: /profile/create
     *
     * @return string|RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function createAction()
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        if(!empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Session:index');
        }

        $form = new FormHandler();

        if(!$form->handle($this->getRequest())){
            return $this->render('profile/create.html.twig');
        }

        $createRequest = new CreateRequest();
        $createRequest = $form->serializeData($createRequest);
        $createRequest->setUserId($this->getUser()->getId());

        $createService = $this->getContainer()->get('profile.create');
        $createResponse = $createService->process($createRequest);

        $session = new Session();

        if(!$createResponse->isSuccess()){
            $session->getFlashBag()->set('danger', 'Something went wrong.');
            return $this->render('profile/create.html.twig');
        }

        $session->set('user', $createResponse->getUser());
        $session->getFlashBag()->set('success', 'Your profile is ready and can be viewed in Profile tab.');

        return $this->redirectToAction('Session:index');
    }

    /**
     * Profile edit action
     * Route: /profile/edit/{userId}
     *
     * @param int $userId
     * @return string|RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     */
    public function editAction(int $userId)
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        if(empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Profile:create');
        }

        $getRequest = new GetRequest();
        $getRequest->setUserId($userId);

        $getService = $this->getContainer()->get('profile.get');
        $getResponse = $getService->process($getRequest);

        $session = new Session();

        if(!$getResponse->isSuccess()){
            $session->getFlashBag()->set('warning', 'Profile doesn\'t exist.');
            return $this->redirectToAction('Session:index');
        }

        $form = new FormHandler();

        if($form->handle($this->getRequest())){
            $editRequest = new EditRequest();
            $editRequest->setProfile($getResponse->getProfile());
            $editRequest = $form->serializeData($editRequest);

            $editService = $this->getContainer()->get('profile.edit');
            $editResponse = $editService->process($editRequest);

            if($editResponse->isSuccess()){
                $session->getFlashBag()->set('success', 'Your profile is edited successfully.');
                return $this->redirectToAction('Profile:index', [
                    'userId' => $userId
                ]);
            }

            $session->getFlashBag()->set('danger', 'Something went wrong!');
        }

        return $this->render("profile/edit.html.twig", [
            'profile' => $getResponse->getProfile()
        ]);
    }
}