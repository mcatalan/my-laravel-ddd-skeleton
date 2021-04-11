<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Repositories;

use Src\Shared\Domain\Dto\AbstractCollectionDto;
use Src\Shared\Domain\Dto\DtoInterface;

interface RepositoryInterface
{
    public function find(int $id): ?DtoInterface;

    public function findBy(
        array $where,
        int $offset = 0,
        int $limit = 0,
        string $sortField = '',
        string $sortOrder = 'asc'
    ): ?AbstractCollectionDto;

    public function create(DtoInterface $entity): DtoInterface;

    public function update(DtoInterface $entity): DtoInterface;

    public function delete(int $id): void;
}
