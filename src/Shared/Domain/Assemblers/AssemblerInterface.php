<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Assemblers;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Collection;
use Src\Shared\Domain\Dto\AbstractCollectionDto;
use Src\Shared\Domain\Dto\DtoInterface;

interface AssemblerInterface
{
    public function assemble(Model $model): DtoInterface;
    public function assembleCollection(Collection $collection): AbstractCollectionDto;
}
