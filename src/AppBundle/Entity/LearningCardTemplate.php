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
class LearningCardTemplate
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Classroom", mappedBy="learningCardTemplate")
     */
    private $classrooms;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Competency", cascade={"persist"})
     */
    private $competencies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
        $this->competencies = new ArrayCollection();;
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
     * Add classrooms
     *
     * @param Classroom $classrooms
     * @return Teacher
     */
    public function addClassroom(Classroom $classrooms)
    {
        $this->classrooms[] = $classrooms;

        return $this;
    }

    /**
     * Remove classrooms
     *
     * @param Classroom $classrooms
     */
    public function removeClassroom(Classroom $classrooms)
    {
        $this->classrooms->removeElement($classrooms);
    }

    /**
     * Get classrooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }

    /**
     * Add competencies
     *
     * @param Competency $competencies
     * @return LearningCardTemplate
     */
    public function addCompetency(Competency $competencies)
    {
        $this->competencies->add($competencies);

        return $this;
    }

    /**
     * Remove competencies
     *
     * @param Competency $competencies
     */
    public function removeCompetency(Competency $competencies)
    {
        $this->competencies->removeElement($competencies);
    }

    /**
     * Get competencies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompetencies()
    {
        return $this->competencies;
    }
}
