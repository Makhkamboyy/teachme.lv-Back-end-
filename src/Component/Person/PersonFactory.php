<?php

namespace App\Component\Person;

use App\Entity\Person;
use App\Entity\User;

class PersonFactory
{

    public function create(string $name, string $sname, User $user): Person
    {
        return (new Person())
            ->setName($name)
            ->setSname($sname)
            ->setUser($user)
        ;

    }

}