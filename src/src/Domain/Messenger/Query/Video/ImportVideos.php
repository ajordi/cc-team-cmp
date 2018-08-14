<?php

namespace App\Domain\Messenger\Query\Video;

use App\Domain\Exception\InvalidParametersException;
use App\Domain\Messenger\Query\Query;

class ImportVideos implements Query
{
    /**
     * @var string
     */
    private $source;

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function source(): string
    {
        return $this->source;
    }

    /**
     * @throws InvalidParametersException
     * @return mixed
     */
    public static function fromArray(array $data)
    {
        try {
            return new static($data['source'] ?? null);
        } catch (\Throwable $e) {
            throw new InvalidParametersException(implode(', ', $data));
        }
    }
}
