<?php

namespace AppBundle\Controller\LearningCardTemplate;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\LearningCardTemplate;
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
     * @Route("/classrooms/view/{id}/learning-card-template")
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
        $template = $classroom->getLearningCardTemplate();
        $form = $this->createForm(new LearningCardTemplateType(), $template);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $template = $form->getData();

            $em->persist($template);
            $em->flush();
        }

        return array(
            'classroom' => $classroom,
            'form' => $form->createView()
        );
    }
}