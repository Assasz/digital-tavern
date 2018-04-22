<?php

namespace DigitalTavern\Ports\Socket;

use DigitalTavern\Application\Service\UserModule\Request\GetRequest;
use League\Container\Container;
use Ratchet\ConnectionInterface as Conn;
use Ratchet\Wamp\WampServerInterface;
use Ratchet\Wamp\Topic;

/**
 * Class ChatSocket
 *
 * Manages chat socket events
 *
 * @package DigitalTavern\Ports\Socket
 */
class ChatSocket implements WampServerInterface
{
    /**
     * Service container
     *
     * @var Container
     */
    private $container;

    /**
     * Connected clients
     *
     * @var \SplObjectStorage
     */
    private $clients;

    /**
     * ChatSocket constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->clients = new \SplObjectStorage();
    }

    /**
     * Executed on publish event
     *
     * @param Conn $conn
     * @param Topic|string $topic
     * @param string $event
     * @param array $exclude
     * @param array $eligible
     */
    public function onPublish(Conn $conn, $topic, $event, array $exclude, array $eligible)
    {
        $msg = json_decode($event, true);
        $feedback = null;

        $request = new GetRequest();
        $request->setUserId($msg['user']);

        $service = $this->container->get('user.get');
        $response = $service->process($request);

        $user = $response->getUser();

        switch ($msg['event']){
            case 'join':
                if(!empty($user) && !$this->clients->contains($user)){
                    $this->clients->attach($user);
                    $feedback = [
                        'msg' => $user->getProfile()->getIgn().' has joined session.',
                        'type' => 'sessionNotification'
                    ];
                }

                break;
            case 'quit':
                if(!empty($user) && $this->clients->contains($user)){
                    $this->clients->detach($user);
                    $feedback = [
                        'msg' => ($user->getCurrentSession()->getHost() == $user || $user->getRole() == 'super game master') ? $user->getProfile()->getIgn().' has ended session. You can leave now.' : $user->getProfile()->getIgn().' has left session.',
                        'type' => 'sessionNotification'
                    ];
                }

                break;
            default:
                $feedback = [
                    'ign' => $user->getProfile()->getIgn(),
                    'msg' => $msg['msg']
                ];

                break;
        }

        if(!empty($feedback)) {
            $topic->broadcast($feedback);
        }
    }

    /**
     * Executed on call event
     *
     * @param Conn $conn
     * @param string $id
     * @param Topic|string $topic
     * @param array $params
     */
    public function onCall(Conn $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'RPC not supported on this demo');
    }

    /**
     * Executed on subscribe event
     *
     * @param Conn $conn
     * @param Topic|string $topic
     */
    public function onSubscribe(Conn $conn, $topic)
    {
    }

    /**
     * Executed on unsubscribe event
     *
     * @param Conn $conn
     * @param Topic|string $topic
     */
    public function onUnSubscribe(Conn $conn, $topic)
    {
    }

    /**
     * Executed on open event
     *
     * @param Conn $conn
     */
    public function onOpen(Conn $conn)
    {
    }

    /**
     * Executed on close event
     *
     * @param Conn $conn
     */
    public function onClose(Conn $conn)
    {
    }

    /**
     * Executed on error event
     *
     * @param Conn $conn
     * @param \Exception $e
     */
    public function onError(Conn $conn, \Exception $e)
    {
        echo 'Error: '.$e->getMessage();
    }
}