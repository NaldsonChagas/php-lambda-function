<?php

namespace ReverseGeocode\SaveFile\Exceptions;

class UploadException extends \RuntimeException
{
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
