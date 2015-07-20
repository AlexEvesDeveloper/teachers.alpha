<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Competency
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Competency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint")
     */
    private $minRange;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint")
     */
    private $maxRange;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint")
     */
    private $currentGrade;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="LearningCardTemplate", mappedBy="competencies")
     */
    private $learningCardTemplates;

    public function __construct()
    {
        $this->currentGrade = 0;
        $this->learningCardTemplates = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Competency
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set currentGrade
     *
     * @param integer $currentGrade
     * @return Competency
     */
    public function setCurrentGrade($currentGrade)
    {
        $this->currentGrade = $currentGrade;

        return $this;
    }

    /**
     * Get currentGrade
     *
     * @return integer 
     */
    public function getCurrentGrade()
    {
        return $this->currentGrade;
    }

    /**
     * Add learningCardTemplates
     *
     * @param LearningCardTemplate $learningCardTemplates
     * @return Competency
     */
    public function addLearningCardTemplate(LearningCardTemplate $learningCardTemplates)
    {
        $this->learningCardTemplates[] = $learningCardTemplates;

        return $this;
    }

    /**
     * Remove learningCardTemplates
     *
     * @param LearningCardTemplate $learningCardTemplates
     */
    public function removeLearningCardTemplate(LearningCardTemplate $learningCardTemplates)
    {
        $this->learningCardTemplates->removeElement($learningCardTemplates);
    }

    /**
     * Get learningCardTemplates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLearningCardTemplates()
    {
        return $this->learningCardTemplates;
    }

    /**
     * @return int
     */
    public function getMinRange()
    {
        return $this->minRange;
    }

    /**
     * @param int $minRange
     * @return $this
     */
    public function setMinRange($minRange)
    {
        $this->minRange = $minRange;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxRange()
    {
        return $this->maxRange;
    }

    /**
     * @param int $maxRange
     * @return $this
     */
    public function setMaxRange($maxRange)
    {
        $this->maxRange = $maxRange;

        return $this;
    }
}
