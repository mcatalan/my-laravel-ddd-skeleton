<?php

namespace Src\Shared\Infrastructure\Bus;

use Src\Shared\Application\Bus\CommandBusInterface;
use Src\Shared\Application\Bus\ContainerInterface;
use Src\Shared\Application\Commands\CommandInterface;

class CommandBus implements CommandBusInterface
{
    private const HANDLER_PREFIX = 'Handler';

    public function __construct(
        private ContainerInterface $container
    )
    {
    }

    public function execute(CommandInterface $command)
    {
        return $this->resolverHandler($command)->__invoke($command);
    }

    private function resolverHandler(CommandInterface $command)
    {
        return $this->container->make(
            $this->getHandlerClass($command)
        );
    }

    private function getHandlerClass(CommandInterface $command): string
    {
        return get_class($command) . self::HANDLER_PREFIX;
    }
}
