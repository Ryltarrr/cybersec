<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ModelIngredient::class, mappedBy="ingredient")
     */
    private $modelIngredients;

    public function __construct()
    {
        $this->modelIngredients = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ModelIngredient[]
     */
    public function getModelIngredients(): Collection
    {
        return $this->modelIngredients;
    }

    public function addModelIngredient(ModelIngredient $modelIngredient): self
    {
        if (!$this->modelIngredients->contains($modelIngredient)) {
            $this->modelIngredients[] = $modelIngredient;
            $modelIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeModelIngredient(
        ModelIngredient $modelIngredient
    ): self {
        if ($this->modelIngredients->removeElement($modelIngredient)) {
            // set the owning side to null (unless already changed)
            if ($modelIngredient->getIngredient() === $this) {
                $modelIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
