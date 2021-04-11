<?php


namespace Src\Shared\Domain\Dto;

abstract class AbstractDto implements DtoInterface
{
    protected array $dateFields = ['createdAt', 'updatedAt', 'deletedAt'];

    public function toArray(bool $withSnakeFieldNames = false, bool $withId = true): array
    {
        $data = [];
        foreach ($this->getPublicFields() as $field) {
            $fieldName = $withSnakeFieldNames ? $this->toSnakeCase($field) : $field;
            $fieldValue = $this->{'get' . ucfirst($field)}();

            if (in_array($field, $this->dateFields)) {
                $fieldValue = $fieldValue->format('Y-m-d H:i:s');
            }

            $data[$fieldName] = $fieldValue;
        }

        if ( !$withId ) {
            unset($data['id']);
        }

        return $data;
    }

    protected function toSnakeCase(string $input): string
    {
        $output = '';

        foreach (str_split($input) as $char) {
            if (ctype_upper($char)) {
                $char = '_' . strtolower($char);
            }

            $output .= $char;
        }

        return $output;
    }
}
