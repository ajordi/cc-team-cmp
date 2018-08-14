<?php

namespace App\Domain\Model\Document;

use App\Domain\Model\Source\Source;

interface DocumentProvider
{
    public function bySource(Source $source): ?Document;
}
