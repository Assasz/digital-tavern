<?php

namespace DigitalTavern\Ports\Controller;

use DigitalTavern\Application\Service\SessionModule\Request\CreateRequest;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
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
        return $this->render('session/_public.html.twig', [], true);
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
}