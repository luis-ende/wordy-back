<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use App\Repository\ExpressionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

use App\Controller\PatchExpressionUnits;

/**
 * @ORM\Entity(repositoryClass=ExpressionRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ApiResource(
 *     collectionOperations={"get","post"={"normalization_context"={"groups"="expression:list"}}},
 *     itemOperations={"get","patch","delete","put"={"normalization_context"={"groups"="expression:item"}}, 
 *                     "add_unit"={"method"="PATCH", "path"="/expressions/{id}/units.{_format}", "controller"=PatchExpressionUnits::class, "defaults"={"format"="jsonld","_api_receive"=false}}},
 *     order={"createdAt"="DESC"},
 *     paginationEnabled=false
 * ) 
 * 
 */
class Expression
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $textLanguage1;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $textLanguage2;

    /**
     * @ORM\Column(type="smallint")
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $language1;

    /**
     * @ORM\Column(type="smallint")
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $language2;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $grammarType;

    /**
     * @ORM\Column(type="boolean")
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $isLearning;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
    private $learningUpdated;

    /**
     * Many Expressions have many Learning units
     * 
     * @ORM\ManyToMany(targetEntity=LearningUnit::class, inversedBy="expressions", cascade={"all"})
     * @ORM\JoinTable(name="expressions_lu")
     *
     */    
    #[ApiSubresource(
        maxDepth: 1,
     )]         
     #[Groups(['expression:list', 'expression:item', 'expression-new:list'])]     
     private $learningUnits;

    /**
     * @ORM\OneToMany(targetEntity=Example::class, mappedBy="expression", orphanRemoval=true)
     */    
    #[ApiSubresource]    
    private $examples;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->learningUnits = new ArrayCollection();
        $this->examples = new ArrayCollection();
    }    

    public function __toString(): string
    {
        return (string) $this->getTextLanguage1();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextLanguage1(): ?string
    {
        return $this->textLanguage1;
    }

    public function setTextLanguage1(string $textLanguage1): self
    {
        $this->textLanguage1 = $textLanguage1;

        return $this;
    }

    public function getTextLanguage2(): ?string
    {
        return $this->textLanguage2;
    }

    public function setTextLanguage2(string $textLanguage2): self
    {
        $this->textLanguage2 = $textLanguage2;

        return $this;
    }

    public function getLanguage1(): ?int
    {
        return $this->language1;
    }

    public function setLanguage1(int $language1): self
    {
        $this->language1 = $language1;

        return $this;
    }

    public function getLanguage2(): ?int
    {
        return $this->language2;
    }

    public function setLanguage2(int $language2): self
    {
        $this->language2 = $language2;

        return $this;
    }

    public function getGrammarType(): ?int
    {
        return $this->grammarType;
    }

    public function setGrammarType(?int $grammarType): self
    {
        $this->grammarType = $grammarType;

        return $this;
    }

    public function getIsLearning(): ?bool
    {
        return $this->isLearning;
    }

    public function setIsLearning(bool $isLearning): self
    {
        $this->isLearning = $isLearning;

        return $this;
    }

    public function getLearningUpdated(): ?\DateTimeInterface
    {
        return $this->learningUpdated;
    }

    public function setLearningUpdated(?\DateTimeInterface $learningUpdated): self
    {
        $this->learningUpdated = $learningUpdated;

        return $this;
    }    

    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues() {        
        if (!isset($this->language1)) {
            $this->language1 = 1;
        }
        if (!isset($this->language2)) {
            $this->language1 = 2;
        }        
        if (!isset($this->isLearning)) {
            $this->isLearning = true;
        }
    }

    /**
     * @return Collection|LearningUnit[]
     */
    public function getLearningUnits(): Collection
    {
        return $this->learningUnits;
    }

    public function addLearningUnits(LearningUnit $learningUnits): self
    {
        if (!$this->learningUnits->contains($learningUnits)) {
            $this->learningUnits[] = $learningUnits;
        }

        return $this;
    }

    public function removeLearningUnits(LearningUnit $learningUnits): self
    {
        $this->learningUnits->removeElement($learningUnits);

        return $this;
    }

    /**
     * @return Collection|Example[]
     */
    public function getExamples(): Collection
    {
        return $this->examples;
    }

    public function addExample(Example $example): self
    {
        if (!$this->examples->contains($example)) {
            $this->examples[] = $example;
            $example->setExpression($this);
        }

        return $this;
    }

    public function removeExample(Example $example): self
    {
        if ($this->examples->removeElement($example)) {
            // set the owning side to null (unless already changed)
            if ($example->getExpression() === $this) {
                $example->setExpression(null);
            }
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

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
    
}
