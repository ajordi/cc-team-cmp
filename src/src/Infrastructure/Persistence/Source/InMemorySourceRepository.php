<?php

namespace App\Infrastructure\Persistence\Source;

use App\Domain\Model\Document\Document;
use App\Domain\Model\Document\DocumentMap;
use App\Domain\Model\Source\BaseSource;
use App\Domain\Model\Source\FileSource;
use App\Domain\Model\Source\Source;
use App\Domain\Model\Source\SourceRepository;

class InMemorySourceRepository implements SourceRepository
{
    const SOURCE_DIR = '../feed-exports/';

    /**
     * @var BaseSource[]
     */
    private $sources;

    public function __construct()
    {
        $this->sources = $this->setSources();
    }

    public function byName(string $name): ?Source
    {
        return $this->sources[$name] ?? null;
    }

    private function setSources(): array
    {
        return [
            'glorf' => new FileSource(
                new BaseSource(
                    'glorf',
                    new DocumentMap('url', 'title', 'tags'),
                    Document::FORMAT_JSON
                ),
                sprintf('%s%s', self::SOURCE_DIR, 'glorf.json')
            ),
            'flub' => new FileSource(
                new BaseSource(
                    'flub',
                    new DocumentMap('url', 'name', 'labels'),
                    Document::FORMAT_YML
                ),
                sprintf('%s%s', self::SOURCE_DIR, 'flub.yaml')
            )
        ];
    }
}
