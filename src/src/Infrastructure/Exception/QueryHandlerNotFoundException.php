<?php

namespace App\Infrastructure\Exception;

class QueryHandlerNotFoundException extends InfrastructureException
{
    /** @var int */
    protected $code = ExceptionCodes::QUERY_HANDLER_NOT_FOUND;

    public function __construct($handlerClass)
    {
        $message = sprintf('Query handler %s not found', $handlerClass);

        parent::__construct($message);
    }
}
