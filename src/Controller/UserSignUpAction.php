<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Component\Person\PersonFactory;
use App\Component\Person\PersonManager;
use App\Component\User\CurrentUser;
use App\Component\User\Dtos\SignUpRequestDto;
use App\Component\User\Dtos\UserDto;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Component\User\UserWithPersonBuilder;
use App\Controller\Base\AbstractController;
use App\Entity\Person;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserSignUpAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
        private UserWithPersonBuilder $userWithPersonBuilder
    )
    {
        parent::__construct($serializer, $validator, $currentUser);
    }


    public function __invoke(
        Request $request,
        PersonManager $personManager,
        UserManager $userManager,
    ): User
    {

        $signUpRequestDto = $this->convertRequestToDto($request);

        $person = $this->buildUserWithPerson($signUpRequestDto);
        $userManager->save($person->getUser());
        $personManager->save($person, true);

        return $person->getUser();

    }

    private function convertRequestToDto(Request $request): SignUpRequestDto
    {
        /** @var SignUpRequestDto $signUpRequestDto */
        $signUpRequestDto = $this->getDtoFromRequest($request, SignUpRequestDto::class);
        $this->validate($signUpRequestDto);

        return $signUpRequestDto;
    }


    private function buildUserWithPerson(SignUpRequestDto $signUpRequestDto): Person
    {
        return $this->userWithPersonBuilder
            ->buildUser($signUpRequestDto->getEmail(), $signUpRequestDto->getPassword())
            ->buildPerson($signUpRequestDto->getName(), $signUpRequestDto->getSname())
            ->getResult();
    }


}