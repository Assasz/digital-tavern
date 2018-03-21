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
     * Session index action
     * Route /session/index, /session
     *
     * @return string|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction()
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

//        if(empty($this->getUser()->getProfile())){
//            return $this->redirectToAction('Profile:create');
//        }

        return $this->render('session/index.html.twig');
    }
}