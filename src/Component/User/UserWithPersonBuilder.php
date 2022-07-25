<?php

namespace App\Component\User;

use App\Component\Person\PersonFactory;
use App\Entity\Person;
use App\Entity\User;

class UserWithPersonBuilder
{

    public function __construct(
        private UserFactory   $userFactory,
        private PersonFactory $personFactory
    )
    {
    }

    private ?User $user = null;
    private Person $person;

    public function buildUser(string $email, string $password):self
    {
        $this->user = $this->userFactory->create($email, $password);
        return $this;
    }

    public function buildPerson(string $name, string $sname):self
    {
        if($this->user === null) {
            throw new \LogicException("You should create User before creating Person");
        }
        $this->person = $this->personFactory->create(
            $name,
            $sname,
            $this->user
        );

        return $this;
    }


    public function getResult(): Person
    {
        return $this->person;
    }


}