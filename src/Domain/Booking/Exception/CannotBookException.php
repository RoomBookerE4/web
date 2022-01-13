<?php

namespace App\Domain\Booking\Exception;

use Throwable;
use DomainException;

class CannotBookException extends DomainException{

    public function __construct(string $message = 'Impossible de réserver une salle.', int $code = 1, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}