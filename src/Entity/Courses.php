<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoursesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['courses:read']],
        ],
        'post' => [
            'security' => "is_granted('ROLE_ADMIN')",
        ]
    ],
    denormalizationContext: ['groups' => ['course:write']],
    normalizationContext: ['groups' => ['course:read', 'courses:read']],
)]
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['courses:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['courses:read', 'course:write'])]
    private ?Price $price = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['courses:read', 'course:write'])]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'course:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['courses:read', 'course:write'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['courses:read', 'course:write'])]
    private ?string $text = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['courses:read', 'course:write'])]
    private ?MediaObject $courseImage = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCourseImage(): ?MediaObject
    {
        return $this->courseImage;
    }

    public function setCourseImage(?MediaObject $courseImage): self
    {
        $this->courseImage = $courseImage;

        return $this;
    }
}
