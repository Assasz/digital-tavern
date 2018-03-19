<?php

namespace DigitalTavern\Ports\Controller;

use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 *
 * @package DigitalTavern\Ports\Controller
 */
class HomeController extends AbstractController
{
    /**
     * Homepage index action
     * Routes: /home/index, /home, /
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Default:index');
        }

        $signinView = $this->siginPartialAction();

        return $this->render('home/index.html.twig', [
            'signinView' => $signinView
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
    public function siginPartialAction(): string
    {
        return $this->render('home/_signin.html.twig', [], true);
    }
}