<?php

declare(strict_types=1);

namespace Src\Example\Application\Providers;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\ServiceProvider;
use Src\Example\Domain\Dto\ExampleDto;
use Src\Example\Infrastructure\Persistence\Assemblers\ExampleDtoAssembler;
use Src\Example\Infrastructure\Persistence\Repositories\ExampleRepository;
use Src\Shared\Domain\Assemblers\AssemblerInterface;

class ExampleServiceProvider extends ServiceProvider
{
    public function register()
    {
        /* persistence */
        $this->app->when(ExampleRepository::class)
            ->needs(AssemblerInterface::class)
            ->give(ExampleDtoAssembler::class);

        $this->app->when(ExampleRepository::class)
            ->needs(Model::class)
            ->give(ExampleDto::class);
    }
}
