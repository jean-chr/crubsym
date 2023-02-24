<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get the value of articles
     * @return Collection|Article[]
     */ 
/*    public function getArticles() :Collection
    {
        return $this->articles;
    }
 
    public function AddArticle(Article $article): self
    {
        if(!$this->articles->contains($article)){
            $this->articles[]= $article;
            $article->setCategory($this);
        }
        return $this;
    }

    public function RemoveArticle(Article $article): self
    {
        if($this->articles->contains($article)){
            $this->articles->removeElement($article);
            //setnull
           if( $article->getCategory() ===$this){
                $article->setCategory(null);
           }
        }
        return $this;
    } */

/**
 * @return Collection<int, Article>
 */
public function getArticles(): Collection
{
    return $this->articles;
}

public function addArticle(Article $article): self
{
    if (!$this->articles->contains($article)) {
        $this->articles->add($article);
        $article->setCategory($this);
    }

    return $this;
}

public function removeArticle(Article $article): self
{
    if ($this->articles->removeElement($article)) {
        // set the owning side to null (unless already changed)
        if ($article->getCategory() === $this) {
            $article->setCategory(null);
        }
    }

    return $this;
}
}
