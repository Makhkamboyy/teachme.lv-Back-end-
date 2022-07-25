<?php declare(strict_types=1);

namespace App\Component\User;

use App\Component\User\Dtos\UserDto;
use App\Component\User\Exceptions\UserFactoryException;
use App\Entity\User;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserFactory
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    )
    {
    }

    public function create(string $email, string $password): User
    {
        $user = new User();

        $user->setEmail($email);

        $hashed = $this->passwordEncoder->hashPassword($user, $password);

        $user->setPassword($hashed);

        return $user;
    }
}
