<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LearningCardTemplate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LearningCard
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
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="learningCards")
     */
    private $student;

    /**
     * @var LearningCardTemplate
     *
     * @ORM\ManyToOne(targetEntity="LearningCardTemplate")
     */
    private $learningCardTemplate;

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
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student $student
     * @return $this
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return LearningCardTemplate
     */
    public function getLearningCardTemplate()
    {
        return $this->learningCardTemplate;
    }

    /**
     * @param LearningCardTemplate $learningCardTemplate
     * @return $this
     */
    public function setLearningCardTemplate(LearningCardTemplate $learningCardTemplate)
    {
        $this->learningCardTemplate = $learningCardTemplate;

        return $this;
    }
}