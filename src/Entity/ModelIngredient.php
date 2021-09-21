<?php

namespace App\Entity;

use App\Repository\ModelIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelIngredientRepository::class)
 */
class ModelIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="modelIngredients")
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="modelIngredients")
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $grammage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getGrammage(): ?int
    {
        return $this->grammage;
    }

    public function setGrammage(int $grammage): self
    {
        $this->grammage = $grammage;

        return $this;
    }
}
