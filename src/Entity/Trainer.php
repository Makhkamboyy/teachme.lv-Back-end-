<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TrainerRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['trainers:read']],
        ],
        'post' => [
            'security' => "is_granted('ROLE_ADMIN')",
        ]
    ],
    denormalizationContext: ['groups' => ['trainer:write']],
    normalizationContext: ['groups' => ['trainer:read', 'trainers:read']],
)]


class Trainer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['trainers:read', 'courses:read', 'favorites:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['trainers:read', 'trainer:write', 'courses:read'])]
    private ?MediaObject $image = null;

    #[ORM\Column(length: 255)]
    #[Groups(['trainers:read', 'trainer:write', 'courses:read', 'favorites:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['trainers:read', 'trainer:write', 'courses:read', 'favorites:read'])]
    private ?string $profession = null;

    #[ORM\Column(length: 255)]
    #[Groups(['trainers:read', 'trainer:write', 'courses:read'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['trainers:read', 'trainer:write', 'courses:read'])]
    private ?string $text = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

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

    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    public function setImage(?MediaObject $image): self
    {
        $this->image = $image;

        return $this;
    }
}
