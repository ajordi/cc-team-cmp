<?php

namespace App\Domain\Model\Source;

use App\Domain\Model\Document\DocumentMap;

interface Source
{
    public function name(): string;

    public function documentMap(): DocumentMap;

    public function contentFormat(): string;
}
