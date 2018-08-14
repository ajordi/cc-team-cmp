<?php

namespace Tests\Unit\Domain\Exception;

use App\Domain\Exception\DomainException;
use App\Domain\Exception\ExceptionCodes;
use App\Domain\Exception\InvalidParametersException;
use PHPUnit\Framework\TestCase;

class InvalidParametersExceptionTest extends TestCase
{
    public function test_valid_exception()
    {
        $message = 'some message';
        $code = 1001;

        try {
            throw new InvalidParametersException($message, $code);
        } catch (InvalidParametersException $invalidParametersException) {
            static::assertInstanceOf(DomainException::class, $invalidParametersException);
            static::assertSame(
                ExceptionCodes::PARAMS_INVALID,
                $invalidParametersException->getCode()
            );
            static::assertSame(
                'Parameters are not valid, got: ' . $message,
                $invalidParametersException->getMessage()
            );
        }
    }
}

