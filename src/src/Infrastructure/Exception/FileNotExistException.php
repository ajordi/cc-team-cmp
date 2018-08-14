<?php

namespace App\Infrastructure\Exception;

use Exception;

class FileNotExistException extends Exception
{
    /** @var int  */
    protected $code = ExceptionCodes::FILE_NOT_EXIST;

    /** @var string  */
    protected $message = 'File not exist';
}
