<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 * @UniqueEntity(fields = "username", targetClass = "AppBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "AppBundle\Entity\User", message="fos_user.email.already_used")
 */
class Student extends User
{
    const ROLE_DEFAULT = 'ROLE_STUDENT';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Student", mappedBy="classrooms")
     */
    protected $classrooms;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="LearningCard", mappedBy="student")
     */
    protected $learningCards;

    public function __construct()
    {
        parent::__construct();

        $this->classrooms = new ArrayCollection();
        $this->learningCards = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }

    /**
     * @param Classroom $classroom
     * @return $this
     */
    public function addClassroom(Classroom $classroom)
    {
        $this->classrooms->add($classroom);

        return $this;
    }

    /**
     * @param Classroom $classroom
     * @return $this
     */
    public function removeClassroom(Classroom $classroom)
    {
        $this->classrooms->removeElement($classroom);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getLearningCards()
    {
        return $this->learningCards;
    }

    /**
     * @param LearningCard $learningCard
     * @return $this
     */
    public function addLearningCard(LearningCard $learningCard)
    {
        $this->learningCards->add($learningCard);

        return $this;
    }

    /**
     * @param LearningCard $learningCard
     * @return $this
     */
    public function removeLearningCard(LearningCard $learningCard)
    {
        $this->learningCards->removeElement($learningCard);

        return $this;
    }
}
