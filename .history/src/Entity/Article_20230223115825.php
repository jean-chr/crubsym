<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
//..
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)] 
    private ?string $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contenu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('titre', new Assert\NotBlank());
        $metadata->addPropertyConstraint('prix', new Assert\NotBlank('message'));
        $metadata->addPropertyConstraint('contenu', new Assert\NotBlank());
        $metadata->addPropertyConstraint('image', new Assert\NotBlank());
        $metadata->addPropertyConstraint('description', new Assert\NotBlank());



        $metadata->addPropertyConstraint('titre', new Assert\Length([
            'min' => 5,
            'max' => 10,
            'minMessage' => 'le titre au min {{ limit }} characters ',
            'maxMessage' => 'titre limite au max {{ limit }} characters',
        ]));

        $metadata->addPropertyConstraint('prix', new Assert\Type([
            'type' => 'integer',
            'message' => 'La valeur {{ value }} n\'est pas valide, {{ type }}.',
        ]));
        
        $metadata->addPropertyConstraint('description', new Assert\Length([
            'min' => 10,
            'max' => 255,
            'minMessage' => 'description au min {{ limit }} characters ',
            'maxMessage' => 'description limite au max {{ limit }} characters',
        ]));
    }
}
