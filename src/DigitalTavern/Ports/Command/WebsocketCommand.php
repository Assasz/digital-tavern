<?php

namespace DigitalTavern\Ports\Command;

use DigitalTavern\Ports\Socket\SessionSocket;
use League\Container\Container;
use Ratchet\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
     * Service container
     *
     * @var Container
     */
    private $container;

    /**
     * WebsocketCommand constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();

        $this->container = $container;
    }

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

        $app = new App("localhost", 8888);
        $app->route('/session', new SessionSocket($this->container), array('*'));

        $app->run();
    }
}