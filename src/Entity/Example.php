<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\ExampleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ApiResource(
 *     collectionOperations={"get","post"={"normalization_context"={"groups"="example:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="example:item"}}},
 *     order={"phrase"="DESC"},
 *     paginationEnabled=false
 * )
 */
#[ORM\Entity(repositoryClass: ExampleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Example
{
    #[Groups(['example:list', 'example:item'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]     
    private $id;

    #[Groups(['example:list', 'example:item'])]
    #[ORM\Column(type: 'text')]     
    private $phrase;

    #[ORM\ManyToOne(targetEntity: Expression::class, inversedBy: 'examples')]
    #[ORM\JoinColumn(nullable: false)]
    private $expression;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->expressions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhrase(): ?string
    {
        return $this->phrase;
    }

    public function setPhrase(string $phrase): self
    {
        $this->phrase = $phrase;

        return $this;
    }

    public function getExpression(): ?Expression
    {
        return $this->expression;
    }

    public function setExpression(?Expression $expression): self
    {
        $this->expression = $expression;

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
