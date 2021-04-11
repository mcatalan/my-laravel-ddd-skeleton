<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Persistence\Repositories;

use App\Exceptions\EntityCreateException;
use App\Exceptions\EntityDeleteException;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\EntityUpdateException;
use Src\Shared\Domain\Dto\AbstractCollectionDto;
use Src\Shared\Domain\Repositories\RepositoryInterface;
use Src\Shared\Domain\Assemblers\AssemblerInterface;
use Src\Shared\Domain\Dto\DtoInterface;

use \Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository implements RepositoryInterface
{
    protected ?Model $model;
    protected AssemblerInterface $assembler;

    public function __construct(Model $model, AssemblerInterface $assembler)
    {
        $this->model = $model;
        $this->assembler = $assembler;
    }

    public function find(int $id): ?DtoInterface
    {
        $model = $this->model->find($id);
        return $this->assembler->assemble($model);
    }

    public function findBy(
        array $where,
        int $offset = 0,
        int $limit = 0,
        string $sortField = '',
        string $sortOrder = 'asc'
    ): ?AbstractCollectionDto {

        $query = $this->model;

        foreach ($where as $field => $value) {
            $query->where($field, '=', $value);
        }

        if ($offset) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        if ($sortField) {
            $query->orderBy($sortField, $sortOrder);
        }

        $models = $query->get();

        return $this->assembler->assembleCollection($models);
    }

    public function create(DtoInterface $entity): DtoInterface
    {
        try {
            $model = $this->model->create(
                $entity->toArray(true, false)
            );

            return $this->assembler->assemble($model);

        } catch (\Throwable $e) {
            throw new EntityCreateException($e->getMessage(), 500, $e);
        }
    }

    public function update(DtoInterface $entity): DtoInterface
    {
        try {
            $model = $this->findOrFail($entity->getId());

        } catch (\Throwable $e) {
            throw new EntityNotFoundException($e->getMessage(), 404, $e);
        }

        $model->fill($entity->toArray());

        try {
            $model->save();

            $this->model = $model;

            return $this->assembler->assemble($model);

        } catch (\Throwable $e) {
            throw new EntityUpdateException($e->getMessage(), 500, $e);
        }
    }

    public function delete(int $id): void
    {
        try {
            $model = $this->findOrFail($id);

        } catch (\Throwable $e) {
            throw new EntityNotFoundException($e->getMessage(), 404, $e);
        }

        try {
            $model->delete();
            $this->model = null;

        } catch (\Throwable $e) {
            throw new EntityDeleteException($e->getMessage(), 500, $e);
        }
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
}
