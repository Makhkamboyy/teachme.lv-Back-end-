<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FavoritesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FavoritesRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['favorites:read']],
        ],
        'post' => [
            'security' => "is_granted('ROLE_ADMIN')",
        ]
    ],
    denormalizationContext: ['groups' => ['favorite:write']],
    normalizationContext: ['groups' => ['favorite:read', 'favorites:read']],
)]
class Favorites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    #[Groups(['favorites:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['favorites:read', 'favorite:write'])]
    private ?Price $price = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['favorites:read', 'favorite:write'])]
    private ?Category $category = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['favorites:read', 'favorite:write'])]
    private ?MediaObject $favorite_image = null;

    #[ORM\Column(length: 255)]
    #[Groups(['favorites:read', 'favorite:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['favorites:read', 'favorite:write'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['favorites:read', 'favorite:write'])]
    private ?string $text = null;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFavoriteImage(): ?MediaObject
    {
        return $this->favorite_image;
    }

    public function setFavoriteImage(?MediaObject $favorite_image): self
    {
        $this->favorite_image = $favorite_image;

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
}
