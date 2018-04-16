<?php

namespace DigitalTavern\Ports\Controller;

use DigitalTavern\Application\Service\SessionModule\Request\CreateRequest;
use DigitalTavern\Application\Service\SessionModule\Request\GetPublicRequest;
use DigitalTavern\Application\Service\SessionModule\Request\SearchRequest;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yggdrasil\Core\Form\FormHandler;

/**
 * Class SessionController
 *
 * Manages sessions actions
 *
 * @package DigitalTavern\Ports\Controller
 */
class SessionController extends AbstractController
{
    /**
     * Session index action
     * Route: /session/index/{type}
     *
     * @return string|Response
     * @param string $type Indicates which sessions should be loaded
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(string $type = 'public')
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        if(empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Profile:create');
        }

        $result = ($type === 'public') ? $this->publicPartialAction() : $this->privatePartialAction();

        return $this->render('session/index.html.twig', [
            'result' => $result
        ]);
    }

    /**
     * Renders public sessions partial view
     *
     * @return string|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function publicPartialAction()
    {
        $request = new GetPublicRequest();

        $service = $this->getContainer()->get('session.get_public');
        $response = $service->process($request);

        return $this->render('session/_public.html.twig', [
            'sessions' => $response->getSessions()
        ], true);
    }

    /**
     * Renders private sessions partial view
     *
     * @return string|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function privatePartialAction()
    {
        return $this->render('session/_private.html.twig', [], true);
    }

    /**
     * Session create action
     * Route: /session/create
     *
     * @return mixed
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

        if(empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Profile:create');
        }

        $form = new FormHandler();

        if(!$form->handle($this->getRequest())){
            return $this->render('session/create.html.twig');
        }

        $request = new CreateRequest();
        $request = $form->serializeData($request);
        $request->setHostId($this->getUser()->getId());

        $service = $this->getContainer()->get('session.create');
        $response = $service->process($request);

        if(!$response->isSuccess()){
            $session = new Session();
            $session->getFlashBag()->set('danger', 'Something went wrong!');

            return $this->render('session/create.html.twig');
        }

        return $this->redirectToAction('Session:index');
    }

    /**
     * Session search action
     * Route: /session/search/{type}
     *
     * @param string $type Indicates which sessions should be loaded
     * @return JsonResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function searchAction(string $type = 'public')
    {
        $form = new FormHandler();

        if(!$this->getRequest()->isXmlHttpRequest() || !$form->handle($this->getRequest())){
            return $this->accessDenied();
        }

        $request = new SearchRequest();
        $request->setQuery($form->getData('search'));
        $request->setType($type);

        $service = $this->getContainer()->get('session.search');
        $response = $service->process($request);

        $result = $this->render('session/_list.html.twig', [
            'sessions' => $response->getSessions()
        ], true);

        return $this->json([$result]);
    }
}