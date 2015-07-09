<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ActivityRepository")
 */
class Activity
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
     * @var Student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="activities")
     */
    protected $student;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Competency", mappedBy="activity")
     */
    protected $competencies;

    public function __construct()
    {
        $this->competencies = new ArrayCollection();
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
     * @return Activity
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
     * Add competencies
     *
     * @param Competency $competencies
     * @return Activity
     */
    public function addCompetency(Competency $competencies)
    {
        $this->competencies[] = $competencies;

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
}
