<?php

namespace App\Application\Service;

class DTOSerializer
{
    /**
     * @param $dtos DTO[]|DTO
     */
    public static function serialize($dtos): array
    {
        if (false === is_array($dtos)) {
            return static::serializeDTO($dtos);
        }

        return array_map(function (DTO $dto) {
            return static::serializeDTO($dto);
        }, $dtos);
    }

    private static function serializeDTO(DTO $dto): array
    {
        return $dto->serialize();
    }
}
