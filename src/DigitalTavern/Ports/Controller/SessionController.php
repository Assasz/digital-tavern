<?php

namespace DigitalTavern\Ports\Controller;

use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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
     * Lists public sessions
     * Route /session/public
     *
     * @return string|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function publicAction()
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        return $this->render('session/public.html.twig');
    }
}