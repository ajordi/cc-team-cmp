<?php

namespace App\Infrastructure\Exception;

use Exception;

class SyntaxException extends Exception
{
    /** @var int  */
    protected $code = ExceptionCodes::SYNTAX_EXCEPTION;

    /** @var string  */
    protected $message = 'Syntax exception';
}
