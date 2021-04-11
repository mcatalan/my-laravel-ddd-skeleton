<?php

namespace Src\Shared\Application\Bus;

interface ContainerInterface
{
    public function make(string $class);
}
