<?php

namespace App\Infrastructure\Messenger;

use App\Domain\Messenger\Query\Query;
use App\Infrastructure\Exception\QueryHandlerNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SimpleQueryBus implements QueryBus
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(Query $query)
    {
        $handlerClass = \get_class($query) . 'Handler';

        /** @var QueryHandler $handler */
        if ($handler = $this->container->get($handlerClass)) {
            return $handler->handle($query);
        }

        throw new QueryHandlerNotFoundException($handlerClass);
    }
}
