<?php


namespace Src\Shared\Domain\Dto;

use Ramsey\Collection\Collection;

abstract class AbstractCollectionDto extends Collection implements CollectionDtoInterface
{
    public function __construct(array $data = [])
    {
        $collectionType = get_class($this);
        parent::__construct($collectionType, $data);
    }
}
