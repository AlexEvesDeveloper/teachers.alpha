<?php

namespace AppBundle\Controller\LearningCardTemplate;

use AppBundle\Entity\Classroom;
use AppBundle\Form\LearningCardTemplateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends Controller
{
    /**
     * @Route("/classrooms/{id}/learning-card-template/view")
     * @Method({"GET", "POST"})
     * @Template("LearningCardTemplate\View\index.html.twig")
     * @ParamConverter("classroom", class="AppBundle:Classroom")
     *
     * @param Request $request
     * @param Classroom $classroom
     * @return array
     */
    public function indexAction(Request $request, Classroom $classroom)
    {
        $form = $this->createForm(new LearningCardTemplateType(), $classroom->getLearningCardTemplate());

        $form->handleRequest($request);
        if ($form->isValid()) {

        }

        return array(
            'classroom' => $classroom,
            'template' => $classroom->getLearningCardTemplate(),
            'form' => $form->createView()
        );
    }
}