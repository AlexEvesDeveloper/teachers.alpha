<?php

namespace AppBundle\Entity;

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
     * @ORM\Column(name="currentGrade", type="smallint")
     */

    public function __construct()
    {
        $this->currentGrade = 0;
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
}
