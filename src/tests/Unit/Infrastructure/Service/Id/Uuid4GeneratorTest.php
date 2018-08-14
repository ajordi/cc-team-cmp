<?php


namespace Tests\Unit\Infrastructure\Service\Id;

use App\Infrastructure\Service\Id\Uuid4Generator;
use Assert\Assertion;
use PHPUnit\Framework\TestCase;

class Uuid4GeneratorTest extends TestCase
{
    public function test_next_is_valid_uuid()
    {
        $uuidGenerator = new Uuid4Generator();
        $uuid = $uuidGenerator->next();

        $this->assertTrue(
            Assertion::uuid($uuid)
        );
    }
}
