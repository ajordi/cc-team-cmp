<?php

namespace Tests\Unit\Infrastructure\Exception;

use App\Infrastructure\Exception\ExceptionCodes;
use App\Infrastructure\Exception\InfrastructureException;
use App\Infrastructure\Exception\QueryHandlerNotFoundException;
use PHPUnit\Framework\TestCase;

class QueryHandlerNotFoundExceptionTest extends TestCase
{
    public function test_valid_exception()
    {
        $handlerClass =  get_class(new \stdClass());

        try {
            throw new QueryHandlerNotFoundException($handlerClass);
        } catch (QueryHandlerNotFoundException $queryHandlerNotFoundException) {
            static::assertInstanceOf(InfrastructureException::class, $queryHandlerNotFoundException);
            static::assertSame(
                ExceptionCodes::QUERY_HANDLER_NOT_FOUND,
                $queryHandlerNotFoundException->getCode()
            );
            static::assertSame(
                'Query handler stdClass not found',
                $queryHandlerNotFoundException->getMessage()
            );
        }
    }
}
