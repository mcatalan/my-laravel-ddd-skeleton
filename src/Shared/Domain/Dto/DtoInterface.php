<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Dto;

interface DtoInterface
{
    public function getPublicFields(): array;
    public function toArray(bool $withSnakeFieldNames = false, bool $withId = true): array;
}
