<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

use App\Repository\LearningUnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ApiResource(
 *     collectionOperations={"get","post"={"normalization_context"={"groups"="learning-unit:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="learning-unit:item"}}},
 *     order={"name"="ASC"},
 *     paginationEnabled=false
 * )
 */
#[ORM\Entity(repositoryClass: LearningUnitRepository::class)]
#[ORM\HasLifecycleCallbacks]
class LearningUnit
{
    #[Groups(['learning-unit:list', 'learning-unit:item'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]     
    private $id;

    #[Groups(['learning-unit:list', 'learning-unit:item'])]
    #[ORM\Column(type: 'string', length: 255)]     
    private $name;

    #[ApiSubresource(
        maxDepth: 1,
     )]
     #[ORM\ManyToMany(targetEntity: Expression::class, mappedBy: 'learningUnits', cascade: ['all'])]         
     private $expressions;

     #[ORM\Column(type: 'datetime')]
     private $createdAt;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTime();
    }
}
