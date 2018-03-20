<?php

namespace DigitalTavern\Ports\Controller;

use DigitalTavern\Application\Service\UserModule\Request\EmailCheckerRequest;
use DigitalTavern\Application\Service\UserModule\Request\RememberedAuthRequest;
use DigitalTavern\Application\Service\UserModule\Request\SignupConfirmationRequest;
use DigitalTavern\Application\Service\UserModule\Request\SignupRequest;
use DigitalTavern\Application\Service\UserModule\Request\UserAuthRequest;
use Symfony\Component\HttpFoundation\Session\Session;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Yggdrasil\Core\Form\FormHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UserController
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Ports\Controller
 */
class UserController extends AbstractController
{
    /**
     * Sign in action
     * Route: /user/signin
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function signinAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Session:public');
        }

        $form = new FormHandler();

        if(!$form->handle($this->getRequest())){
            return $this->redirectToAction('Home:index');
        }

        $rememberMe = $form->hasData('remember_me');

        $authRequest = new UserAuthRequest();
        $authRequest = $form->serializeData($authRequest);
        $authRequest->setRemember($rememberMe);

        $authService = $this->getContainer()->get('user.auth');
        $authResponse = $authService->process($authRequest);

        $session = new Session();

        if(!$authResponse->isSuccess()){
            $session->getFlashBag()->set('danger', 'Authentication failed. Incorrect e-mail address or password.');
            return $this->redirectToAction('Home:index');
        }

        if(!$authResponse->isEnabled()){
            $session->getFlashBag()->set('danger', 'Account is not activated. Check your mailbox for confirmation mail.');
            return $this->redirectToAction('Home:index');
        }

        $session->set('is_granted', true);
        $session->set('user', $authResponse->getUser());

        if($rememberMe){
            $cookie['identifier'] = $authResponse->getUser()->getRememberIdentifier();
            $cookie['token'] = $authResponse->getRememberToken();

            $this->getResponse()->headers->setCookie(new Cookie('remember', serialize($cookie), strtotime('now + 1 week')));
        }

        return $this->redirectToAction('Session:public');
    }

    /**
     * Sign out action
     * Route: /user/signout
     *
     * @return RedirectResponse
     */
    public function signoutAction()
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Session:public');
        }

        $session = new Session();
        $session->invalidate();

        if($this->getResponse()->headers->has('set-cookie') || $this->getRequest()->cookies->has('remember')){
            $this->getResponse()->headers->clearCookie('remember');
        }

        return $this->redirectToAction('Home:index');
    }

    /**
     * Remember me cookie authentication passive action
     *
     * @return Response
     */
    public function authCookiePassiveAction()
    {
        $session = new Session();

        if($this->getRequest()->cookies->has('remember') && !$session->has('is_granted')){
            $cookie = unserialize($this->getRequest()->cookies->get('remember'));

            $authRequest = new RememberedAuthRequest();
            $authRequest->setRememberIdentifier($cookie['identifier']);
            $authRequest->setRememberToken($cookie['token']);

            $authService = $this->getContainer()->get('user.remembered_auth');
            $authResponse = $authService->process($authRequest);

            if($authResponse->isSuccess()){
                $session->set('is_granted', true);
                $session->set('user', $authResponse->getUser());

                $this->getResponse()->headers->setCookie(new Cookie('remember', serialize($cookie), strtotime('now + 1 week')));
            }
        }

        return $this->getResponse();
    }

    /**
     * Sign up action
     * Route: /user/signup
     *
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function signupAction()
    {
        if($this->isGranted()){
            return $this->redirectToAction('Session:public');
        }

        $form = new FormHandler();

        if($form->handle($this->getRequest())){
            $signupRequest = new SignupRequest();
            $signupRequest = $form->serializeData($signupRequest);
            $signupService = $this->getContainer()->get('user.signup');
            $response = $signupService->process($signupRequest);

            $session = new Session();

            if($response->isSuccess()){
                $session->getFlashBag()->set('success', 'Account created successfully. Check your mailbox for confirmation mail.');
            } else {
                $session->getFlashBag()->set('danger', 'Something went wrong.');
            }
        }

        return $this->redirectToAction('Home:index', [
            'partial' => 'signup'
        ]);
    }

    /**
     * Check email action
     * Route: /user/checkemail
     *
     * Used by jQuery validation to indicate if email address is already taken or not
     *
     * @return JsonResponse
     */
    public function checkEmailAction()
    {
        $checkerRequest = new EmailCheckerRequest();
        $checkerRequest->setEmail($this->getRequest()->request->get('email'));

        $checkerService = $this->getContainer()->get('user.email_checker');
        $checkerResponse = $checkerService->process($checkerRequest);

        if(!$checkerResponse->isSuccess()){
            return $this->json(['This email address is already taken.']);
        }

        return $this->json(["true"]);
    }

    /**
     * Sign up confirmation action
     * Route: /user/signupconfirmation/{token}
     *
     * @param string $token
     * @return RedirectResponse
     */
    public function signupConfirmationAction(string $token)
    {
        $confirmationRequest = new SignupConfirmationRequest();
        $confirmationRequest->setToken($token);

        $confirmationService = $this->getContainer()->get('user.signup_confirmation');
        $confirmationResponse = $confirmationService->process($confirmationRequest);

        $session = new Session();

        if($confirmationResponse->isAlreadyActive()){
            $session->getFlashBag()->set('warning', 'This account is already active.');
        } elseif (!$confirmationResponse->isSuccess()){
            $session->getFlashBag()->set('warning', 'Invalid confirmation token.');
        } else {
            $session->getFlashBag()->set('success', 'Account activated successfully. Now you can sign in!');
        }

        return $this->redirectToAction('Home:index');
    }
}