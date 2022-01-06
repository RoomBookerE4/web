<?php

namespace App\Domain\Auth;

use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Handle changes for a user.
 */
class UserService{

    /**
     * Dependy Injection. We need the entity Manager.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository
    )
    {
        
    }

    /**
     * Create a user based on their name, defined role, password, or surname.
     *
     * @param [type] $name
     * @param [type] $role
     * @param [type] $password
     * @param [type] $surname
     * @return void
     */
    public function createUser(string $name, string $role, string $password, string $surname): User
    {
        // Assign values to User object.
        $user = new User();
        $user->setName($name);
        $user->setRole($role);
        $user->setRoles([$role]);
        $user->setPassword($password);
        $user->setSurname($surname);

        // Persist into database.
        $this->em->persist($user);
        // Flushing : refresh the objects with persisted changes.
        $this->em->flush();

        return $user;
    }

    /**
     * Delete a user following its id.
     *
     * @param integer $id
     * @return void
     */
    public function deleteUser(int $id): void
    {
        // Find the wanted user.
        $user = $this->userRepository->find($id);

        // If the user does not exist, we throw an exception.
        if($user === null){
            throw new EntityNotFoundException("L'utilisateur à supprimer n'existe pas.");
        }

        // Remove the user from the database AND flush the User object.
        $this->em->remove($user);
        $this->em->flush();
    }

}