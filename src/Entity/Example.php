<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\ExampleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ExampleRepository::class)
 * 
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="example:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="example:item"}}},
 *     order={"phrase"="DESC"},
 *     paginationEnabled=false
 * ) 
 */
class Example
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['example:list', 'example:item'])]     
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(['example:list', 'example:item'])]     
    private $phrase;

    /**
     * @ORM\ManyToOne(targetEntity=Expression::class, inversedBy="examples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $expression;

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
}
