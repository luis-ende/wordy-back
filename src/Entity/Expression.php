<?php

namespace App\Entity;

use App\Repository\ExpressionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpressionRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Expression
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
    private $textLanguage1;

    /**
     * @ORM\Column(type="text")
     */
    private $textLanguage2;

    /**
     * @ORM\Column(type="smallint")
     */
    private $language1;

    /**
     * @ORM\Column(type="smallint")
     */
    private $language2;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $grammarType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLearning;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $learningUpdated;

    /**
     * Many Expressions have many Learning units
     * 
     * @ORM\ManyToMany(targetEntity=LearningUnit::class, inversedBy="expressions")
     * @ORM\JoinTable(name="expressions_lu")
     */
    private $learningUnits;    

    public function __construct()
    {
        $this->learningUnits1 = new ArrayCollection();
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

    public function getLearningUnit(): ?LearningUnit
    {
        return $this->learningUnit;
    }

    public function setLearningUnit(?LearningUnit $learningUnit): self
    {
        $this->learningUnit = $learningUnit;

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
            $this->isLearning = false;
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
            $this->learningUnits1[] = $learningUnits;
        }

        return $this;
    }

    public function removeLearningUnits(LearningUnit $learningUnits): self
    {
        $this->learningUnits->removeElement($learningUnits);

        return $this;
    }   
}
