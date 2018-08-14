<?php

namespace Tests\Unit\Infrastructure\Messenger;

use App\Domain\Messenger\Query\Video\ImportVideos;
use App\Domain\Messenger\Query\Video\ImportVideosHandler;
use App\Infrastructure\Exception\QueryHandlerNotFoundException;
use App\Infrastructure\Messenger\QueryBus;
use App\Infrastructure\Messenger\SimpleQueryBus;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SimpleQueryBusTest extends TestCase
{
    /** @var ContainerInterface */
    private $container;

    /** @var QueryBus */
    private $queryBus;

    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->queryBus = new SimpleQueryBus($this->container->reveal());
    }

    public function test_it_should_dispatch_query_when_handler_found()
    {
        $query = ImportVideos::fromArray(['source' => 'some-source']);

        /** @var ChargeListHandler $handler */
        $handler = $this->prophesize(ImportVideosHandler::class);
        $handler->handle($query)->shouldBeCalled();

        $this->container->get(ImportVideosHandler::class)
            ->shouldBeCalled()
            ->willReturn($handler);

        $this->queryBus->dispatch($query);
    }

    public function test_it_should_throw_exception_when_handler_not_found()
    {
        $query = ImportVideos::fromArray(['source' => 'some-source']);

        /** @var ChargeListHandler $handler */
        $handler = $this->prophesize(ImportVideosHandler::class);
        $handler->handle($query)->shouldNotBeCalled();

        $this->container->get(ImportVideosHandler::class)
            ->shouldBeCalled()
            ->willReturn(null);

        $this->expectException(QueryHandlerNotFoundException::class);

        $this->queryBus->dispatch($query);
    }
}
