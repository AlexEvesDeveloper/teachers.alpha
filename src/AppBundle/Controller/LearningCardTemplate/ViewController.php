<?php

namespace AppBundle\Controller\LearningCardTemplate;

use AppBundle\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ViewController extends Controller
{
    /**
     * @Route("/classrooms/{id}/learning-card-template/view")
     * @Method({"GET"})
     * @Template("LearningCardTemplate\View\index.html.twig")
     * @ParamConverter("classroom", class="AppBundle:Classroom")
     *
     * @param Classroom $classroom
     * @return array
     */
    public function indexAction(Classroom $classroom)
    {
        return array(
            'classroom' => $classroom,
            'template' => $classroom->getLearningCardTemplate()
        );
    }
}