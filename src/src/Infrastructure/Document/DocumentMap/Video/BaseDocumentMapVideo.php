<?php

namespace App\Infrastructure\Document\DocumentMap\Video;

use App\Application\Service\IdGenerator;

class BaseDocumentMapVideo
{
    /**
     * @var IdGenerator
     */
    protected $idGenerator;

    public function __construct(IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }
}
