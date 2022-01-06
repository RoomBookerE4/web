<?php

namespace App\Domain\Shared\ValueObject;

abstract class StringValueObject{

    public function __construct(private string $value)
    {
        
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }

}