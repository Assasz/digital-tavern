<?php

namespace DigitalTavern\Ports\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use DigitalTavern\Ports\Socket\ChatSocket;

/**
 * Class WebsocketCommand
 *
 * Command running WebSockets server on port 8888
 *
 * @package DigitalTavern\Ports\Command
 */
class WebsocketCommand extends Command
{
    /**
     * Configures command
     */
    protected function configure(): void
    {
        $this
            ->setName('app:websockets:run')
            ->setDescription('Runs WebSockets server.')
            ->setHelp('This command allows you to run WebSockets server.');
    }

    /**
     * Executes command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->write('Server is running!');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatSocket()
                )
            ),
            8888
        );

        $server->run();
    }
}