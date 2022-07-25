<?php

namespace App\Component\User\Dtos;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class SignUpRequestDto
{
    public function __construct(
        #[Assert\Length(min: 2)]
        #[Groups(['user:write', 'user:read'])]
        private string $name,
        #[Assert\Length(min: 2)]
        #[Groups(['user:write', 'user:read'])]
        private string $sname,
        #[Assert\Email]
        #[Groups(['user:write', 'user:read'])]
        private string $email,
        #[Assert\Length(min: 6)]
        #[Groups(['user:write', 'user:read'])]
        private string $password
    )
    {
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getSname(): string
    {
        return $this->sname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}