<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelRepository::class)
 */
class Model
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
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $range;

    /**
     * @ORM\OneToMany(targetEntity=ModelIngredient::class, mappedBy="model")
     */
    private $modelIngredients;

    /**
     * @ORM\ManyToOne(targetEntity=Process::class, inversedBy="models")
     * @ORM\JoinColumn(nullable=false)
     */
    private $process;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRange(): ?string
    {
        return $this->range;
    }

    public function setRange(string $range): self
    {
        $this->range = $range;

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
            $modelIngredient->setModel($this);
        }

        return $this;
    }

    public function removeModelIngredient(
        ModelIngredient $modelIngredient
    ): self {
        if ($this->modelIngredients->removeElement($modelIngredient)) {
            // set the owning side to null (unless already changed)
            if ($modelIngredient->getModel() === $this) {
                $modelIngredient->setModel(null);
            }
        }

        return $this;
    }

    public function getProcess(): ?Process
    {
        return $this->process;
    }

    public function setProcess(?Process $process): self
    {
        $this->process = $process;

        return $this;
    }
}
