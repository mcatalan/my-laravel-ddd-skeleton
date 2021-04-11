<?php

namespace Src\Example\Application\Commands;

use Src\Shared\Application\Commands\CommandInterface;

class ExampleCreateCommand implements CommandInterface
{
    public function __construct(
        private string $title,
        private string $description
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
