<?php

namespace App\Entity;

use App\Repository\ExampleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExampleRepository::class)
 */
class Example
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
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
