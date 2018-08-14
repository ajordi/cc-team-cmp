<?php

namespace App\Infrastructure\Service\Id;

use App\Application\Service\IdGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Uuid4Generator implements IdGenerator
{
    /**
     * @return UuidInterface
     * @throws \Exception
     */
    public function next(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
