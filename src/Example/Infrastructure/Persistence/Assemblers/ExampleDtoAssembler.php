<?php

declare(strict_types=1);

namespace Src\Example\Infrastructure\Persistence\Assemblers;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Src\Example\Domain\Dto\ExampleCollectionDto;
use Src\Example\Domain\Dto\ExampleDto;
use Src\Shared\Domain\Dto\AbstractCollectionDto;
use Src\Shared\Domain\Dto\DtoInterface;
use Src\Shared\Domain\Assemblers\AssemblerInterface;

class ExampleDtoAssembler implements AssemblerInterface
{
    public function assemble(Model $model): DtoInterface
    {
        return new ExampleDto(
            $model->id,
            $model->title,
            $model->description,
            new DateTime($model->created_at->format('Y-m-d H:i:s')),
            new DateTime($model->updated_at->format('Y-m-d H:i:s'))
        );
    }

    public function assembleCollection(Collection $collection): AbstractCollectionDto
    {
        $collectionDto = new ExampleCollectionDto();

        foreach ($collection as $model) {
            $collectionDto->add(
                $this->assemble($model)
            );
        }

        return $collectionDto;
    }
}
