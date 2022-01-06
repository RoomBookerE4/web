<?php

namespace App\Domain\Auth;

use App\Domain\Shared\ValueObject\Enum;

/**
 * Represents a User role.
 * A role must match defined roles.
 */
class UserRole extends Enum{

    public const ROLE_STUDENT = 'student';
    public const ROLE_TEACHER = 'teacher';
    public const ROLE_ADMIN   = 'admin';

}