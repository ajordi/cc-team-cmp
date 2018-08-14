<?php

namespace App\Infrastructure\Messenger;

use App\Domain\Messenger\Query\Query;
use App\Infrastructure\Exception\QueryHandlerNotFoundException;

/**
 * Dispatches query objects to the subscribed query handlers.
 */
interface QueryBus
{
    /**
     * Dispatches the query $query to the proper QueryHandler
     *
     * @return mixed
     * @throws QueryHandlerNotFoundException
     */
    public function dispatch(Query $query);
}
