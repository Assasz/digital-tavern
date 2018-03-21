<?php

namespace DigitalTavern\Ports\Controller;

use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProfileController
 *
 * @package DigitalTavern\Ports\Controller
 */
class ProfileController extends AbstractController
{
    /**
     * Create action, executed with user first sign in
     * Route: /profile/create
     *
     * @return string|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function createAction()
    {
        return $this->render('profile/create.html.twig');
    }
}