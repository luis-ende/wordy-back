<?php

namespace App\Entity;

use App\Repository\LearningUnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LearningUnitRepository::class)
 */
class LearningUnit
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
     * @ORM\OneToMany(targetEntity=Expression::class, mappedBy="learningUnit")
     */
    private $expressions;

    public function __construct()
    {
        $this->expressions = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->getName();
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

    /**
     * @return Collection|Expression[]
     */
    public function getExpressions(): Collection
    {
        return $this->expressions;
    }

    public function addExpression(Expression $expression): self
    {
        if (!$this->expressions->contains($expression)) {
            $this->expressions[] = $expression;
            $expression->setLearningUnit($this);
        }

        return $this;
    }

    public function removeExpression(Expression $expression): self
    {
        if ($this->expressions->removeElement($expression)) {
            // set the owning side to null (unless already changed)
            if ($expression->getLearningUnit() === $this) {
                $expression->setLearningUnit(null);
            }
        }

        return $this;
    }
}
