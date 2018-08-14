<?php

namespace App\Domain\Messenger\Query;

use App\Domain\Exception\InvalidParametersException;

interface Query
{
    /**
     * @throws InvalidParametersException
     * @return mixed
     */
    public static function fromArray(array $data);
}
