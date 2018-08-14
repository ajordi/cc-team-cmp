<?php

namespace App\Infrastructure\Exception;

use Exception;

class InvalidDocumentFormatException extends Exception
{
    /** @var int */
    protected $code = ExceptionCodes::INVALID_DOCUMENT_FORMAT;

    /** @var string  */
    protected $message = 'Invalid document format';
}
