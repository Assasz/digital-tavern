<?php

namespace {
    define('BASE_URL', 'http://localhost/digitaltavern/web/');
}

namespace DigitalTavern\Ports\Socket {

    use DigitalTavern\Application\Service\SessionModule\Request\RenderMessageRequest;
    use DigitalTavern\Application\Service\UserModule\Request\GetRequest;
    use DigitalTavern\Domain\Entity\User;
    use League\Container\Container;
    use Ratchet\ConnectionInterface as Conn;
    use Ratchet\Wamp\WampServerInterface;
    use Ratchet\Wamp\Topic;

    /**
     * Class SessionSocket
     *
     * Manages session socket events
     *
     * @package DigitalTavern\Ports\Socket
     */
    class SessionSocket implements WampServerInterface
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
         * SessionSocket constructor.
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
            $message = null;

            $user = $this->getUser($msg['user']);

            switch ($msg['event']) {
                case 'join':
                    if (!empty($user) && !$this->clients->contains($user)) {
                        $this->clients->attach($user);
                        $message = $this->renderMessage($msg, $topic->getId(), $user);
                    }

                    break;
                case 'quit':
                    if (!empty($user) && $this->clients->contains($user)) {
                        $this->clients->detach($user);
                        $message = $this->renderMessage($msg, $topic->getId(), $user);
                    }

                    break;
                default:
                    $message = $this->renderMessage($msg, $topic->getId(), $user);
                    break;
            }

            if (!empty($message)) {
                $topic->broadcast(['msg' => $message]);
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
            echo 'Error: ' . $e->getMessage();
        }

        /**
         * Gets user
         *
         * @param int $userId
         * @return mixed
         */
        private function getUser(int $userId)
        {
            $request = new GetRequest();
            $request->setUserId($userId);

            $service = $this->container->get('user.get');
            $response = $service->process($request);

            return $response->getUser();
        }

        /**
         * Renders session message template
         *
         * @param array $msg
         * @param string $channel
         * @param User $user
         * @return mixed
         */
        public function renderMessage(array $msg, string $channel, User $user)
        {
            $content = null;

            switch ($msg['event']) {
                case 'join':
                    $content = $user->getProfile()->getIgn() . ' has joined session.';
                    $user = null;
                    break;
                case 'quit':
                    $content = $user->getProfile()->getIgn() . ' has left session.';
                    $user = null;
                    break;
                default:
                    $content = $msg['content'];
                    break;
            }

            $request = new RenderMessageRequest();
            $request->setContent($content);
            $request->setChannel($channel);

            if (!empty($user)) {
                $request->setUser($user);
            }

            $service = $this->container->get('session.render_message');
            $response = $service->process($request);

            if (!empty($response->getMessageTemplate())) {
                return $response->getMessageTemplate();
            }
        }
    }
}