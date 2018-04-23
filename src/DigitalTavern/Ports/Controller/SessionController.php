<?php

namespace DigitalTavern\Ports\Controller;

use DigitalTavern\Application\Service\SessionModule\Request\ChannelCheckRequest;
use DigitalTavern\Application\Service\SessionModule\Request\CreateRequest;
use DigitalTavern\Application\Service\SessionModule\Request\GetCurrentRequest;
use DigitalTavern\Application\Service\SessionModule\Request\GetPlayersRequest;
use DigitalTavern\Application\Service\SessionModule\Request\GetPublicRequest;
use DigitalTavern\Application\Service\SessionModule\Request\GetRequest;
use DigitalTavern\Application\Service\SessionModule\Request\JoinRequest;
use DigitalTavern\Application\Service\SessionModule\Request\LeaveRequest;
use DigitalTavern\Application\Service\SessionModule\Request\SearchRequest;
use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

        if(!empty($this->getUser()->getCurrentSession())){
            $request = new GetCurrentRequest();
            $request->setUserId($this->getUser()->getId());

            $service = $this->getContainer()->get('session.get_current');
            $response = $service->process($request);

            if(!empty($response->getSession())){
                return $this->redirectToAction('Session:play', [$response->getSession()->getChannel()]);
            }
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

        if(!empty($this->getUser()->getCurrentSession())){
            $request = new GetCurrentRequest();
            $request->setUserId($this->getUser()->getId());

            $service = $this->getContainer()->get('session.get_current');
            $response = $service->process($request);

            if(!empty($response->getSession())){
                return $this->redirectToAction('Session:play', [$response->getSession()->getChannel()]);
            }
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

        return $this->redirectToAction('Session:play', [$response->getChannel()]);
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

    /**
     * Session play action
     * Route: /session/play/{channel}
     *
     * @param string $channel Session WebSocket channel
     * @return mixed
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function playAction(string $channel)
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        if(empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Profile:create');
        }

        if(!empty($this->getUser()->getCurrentSession())){
            $request = new GetCurrentRequest();
            $request->setUserId($this->getUser()->getId());

            $service = $this->getContainer()->get('session.get_current');
            $response = $service->process($request);

            $session = $response->getSession();
            if(!empty($session) && $session->getChannel() !== $channel){
                return $this->redirectToAction('Session:play', [$session->getChannel()]);
            }
        }

        $request = new JoinRequest();
        $request->setChannel($channel);
        $request->setUserId($this->getUser()->getId());

        $service = $this->getContainer()->get('session.join');
        $response = $service->process($request);

        $session = new Session();

        if(!$response->isSuccess()){
            return $this->redirectToAction('Session:index');
        }

        if(!empty($response->getUser())){
            $session->set('user', $response->getUser());
        }

        if(empty($session->get('current_channel'))){
            $session->set('current_channel', $channel);
        }

        return $this->render('session/play.html.twig', [
            'session' => $response->getSession()
        ]);
    }

    /**
     * Leave session action
     * Route: /session/leave/{channel}
     *
     * @param string $channel
     * @return RedirectResponse
     */
    public function leaveAction(string $channel)
    {
        if(!$this->isGranted()){
            return $this->redirectToAction('Home:index');
        }

        if(empty($this->getUser()->getProfile())){
            return $this->redirectToAction('Profile:create');
        }

        $request = new LeaveRequest();
        $request->setChannel($channel);
        $request->setUser($this->getUser());

        $service = $this->getContainer()->get('session.leave');
        $response = $service->process($request);

        $session = new Session();

        if(!empty($response->getUser())){
            $session->set('user', $response->getUser());
        }

        $session->set('current_channel', null);

        return $this->redirectToAction('Session:index');
    }

    /**
     * Session stream action for Event Source
     * Route: /session/stream/{channel}
     *
     * @param string $channel
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function streamAction(string $channel)
    {
        $playersRequest = new GetPlayersRequest();
        $playersRequest->setChannel($channel);

        $playersService = $this->getContainer()->get('session.get_players');
        $playersResponse = $playersService->process($playersRequest);


        if(!empty($playersResponse->getPlayers())){
            $template = $this->render('session/_players.html.twig', [
                'players' => $playersResponse->getPlayers()
            ], true);

            $this->getDriver('eventSource')->players->send(json_encode($template));
            $this->getDriver('eventSource')->playersCount->send(json_encode(count($playersResponse->getPlayers())));
        }

        $sessionRequest = new GetRequest();
        $sessionRequest->setChannel($channel);

        $sessionService = $this->getContainer()->get('session.get');
        $sessionResponse = $sessionService->process($sessionRequest);

        if(empty($sessionResponse->getSession())){
            $this->getDriver('eventSource')->end->send(json_encode(true));
        }

        return $this->getResponse();
    }

    /**
     * Response content type control passive action
     *
     * @return Response
     */
    public function contentControlPassiveAction()
    {
        $response = $this->getResponse();
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }
}