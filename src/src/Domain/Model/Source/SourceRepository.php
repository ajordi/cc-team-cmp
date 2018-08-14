<?php

namespace App\Domain\Model\Source;

interface SourceRepository
{
    public function byName(string $name): ?Source;
}
