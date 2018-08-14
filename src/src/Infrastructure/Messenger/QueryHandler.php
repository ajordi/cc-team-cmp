<?php

namespace App\Infrastructure\Messenger;

use App\Domain\Messenger\Query\Query;

interface QueryHandler
{
    /**
     * @return mixed
     */
    public function handle(Query $query);
}
