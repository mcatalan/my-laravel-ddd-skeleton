<?php


namespace Src\Shared\Infrastructure\Bus;

use Illuminate\Container\Container;
use Src\Shared\Application\Bus\ContainerInterface;

class LaravelContainer implements ContainerInterface
{
    public function __construct(
        private Container $container
    )
    {
    }

    public function make(string $class)
    {
        return $this->container->make($class);
    }
}
