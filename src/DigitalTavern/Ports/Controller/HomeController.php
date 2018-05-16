<?php

namespace DigitalTavern\Ports\Controller;

use DigitalTavern\Domain\Entity\Session;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 *
 * Manages homepage actions
 *
 * @package DigitalTavern\Ports\Controller
 */
class HomeController extends AbstractController
{
    /**
     * Homepage index action
     * Route: /home/index/{partial}
     *
     * @param string $partial Indicates which partial view should be loaded
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(string $partial = 'signin')
    {
        if($this->isGranted()){
            return $this->redirectToAction('Session:index');
        }

        $form = ($partial === 'signup') ? $this->signupPartialAction() : $this->siginPartialAction();

        return $this->render('home/index.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * Renders sign in partial view
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function siginPartialAction()
    {
        return $this->render('home/_signin.html.twig', [], true);
    }

    /**
     * Renders sign up partial view
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function signupPartialAction()
    {
        return $this->render('home/_signup.html.twig', [], true);

    }
}