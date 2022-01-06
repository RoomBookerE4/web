<?php

namespace App\Domain\Auth;

use App\Domain\Auth\UserId;
use App\Domain\Shared\AggregateRoot;

/**
 * Represents a User
 */
final class User extends AggregateRoot{

    private UserId $id;
    private UserName $name;
    private UserRole $role;
    private UserPassword $password;
    private UserSurname $surname;

    public function __construct(UserId $id, )
    {
        
    }

    public static function create(UserName $name, UserRole $role, UserPassword $password, UserSurname $surname): self
    {
        return new User();
    }


    
}