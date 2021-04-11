<?php

namespace Src\Example\Application\Commands;

use DateTime;
use Src\Example\Domain\Dto\ExampleDto;
use Src\Example\Infrastructure\Persistence\Assemblers\ExampleDtoAssembler;
use Src\Example\Infrastructure\Persistence\Entities\Example;
use Src\Example\Infrastructure\Persistence\Repositories\ExampleRepository;
use Src\Shared\Application\Commands\CommandHandlerInterface;
use Src\Shared\Domain\Dto\DtoInterface;

class ExampleCreateCommandHandler implements CommandHandlerInterface
{
    private ExampleRepository $repository;

    public function __construct()
    {
        $this->repository = new ExampleRepository(
            new Example(),
            new ExampleDtoAssembler()
        );
    }

    public function __invoke(ExampleCreateCommand $command): DtoInterface
    {
        $example = new ExampleDto(
            null,
            $command->getTitle(),
            $command->getDescription(),
            new DateTime(),
            new DateTime()
        );

        return $this->repository->create($example);
    }
}
