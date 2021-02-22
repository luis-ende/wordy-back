<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\LearningUnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LearningUnitRepository::class)
 * 
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="learning_unit:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="learning_unit:item"}}},
 *     order={"name"="DESC"},
 *     paginationEnabled=false
 * ) 
 */
class LearningUnit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['learning_unit:list', 'learning_unit:item'])]     
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['learning_unit:list', 'learning_unit:item'])]     
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Expression::class, mappedBy="learningUnits")
     */
    #[Groups(['learning_unit:list', 'learning_unit:item'])]     
    private $expressions;

    public function __construct()
    {
        $this->expressions = new ArrayCollection();
        $this->expressionGroup = new ArrayCollection();
        $this->expressions1 = new ArrayCollection();
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

    public function addExpressions(Expression $expressions): self
    {
        if (!$this->expressions->contains($expressions)) {
            $this->expressions[] = $expressions;
            $expressions->addLearningUnits($this);
        }

        return $this;
    }

    public function removeExpressions(Expression $expressions): self
    {
        if ($this->expressions->removeElement($expressions)) {
            $expressions->removeLearningUnits($this);
        }

        return $this;
    }
}
