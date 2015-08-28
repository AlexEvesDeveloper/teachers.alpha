<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Classroom
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Classroom
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="classrooms")
     */
    private $teacher;

    /**
     * @var LearningCardTemplate
     *
     * @ORM\ManyToOne(targetEntity="LearningCardTemplate", inversedBy="classrooms", cascade={"persist"})
     */
    private $learningCardTemplate;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Student", inversedBy="students")
     */
    private $students;

    /**
     * Classroom constructor.
     */
    public function __construct()
    {
        $this->students = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Classroom
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set teacher
     *
     * @param Teacher $teacher
     * @return Classroom
     */
    public function setTeacher(Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
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
    public function setLearningCardTemplate($learningCardTemplate)
    {
        $this->learningCardTemplate = $learningCardTemplate;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param Student $student
     */
    public function addStudent(Student $student)
    {
        $this->students->add($student);
    }

    /**
     * @param Student $student
     */
    public function removeStudent(Student $student)
    {
        $this->students->removeElement($student);
    }
}
