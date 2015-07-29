<?php

namespace AppBundle\Controller\LearningCardTemplate;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\LearningCardTemplate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class CreateController extends Controller
{
    /**
     * @Route("/classrooms/{id}/learning-card-template/create")
     * @Method({"GET"})
     * @ParamConverter("classroom", class="AppBundle:Classroom")
     *
     * @param Request $request
     * @param Classroom $classroom
     * @return array
     */
    public function indexAction(Request $request, Classroom $classroom)
    {
        $template = new LearningCardTemplate();
        $template->addClassroom($classroom);
        $classroom->setLearningCardTemplate($template);

        $em = $this->getDoctrine()->getManager();
        $em->persist($template);
        $em->persist($classroom);
        $em->flush();

        return $this->redirectToRoute('app_learningcardtemplate_view_index', array('id' => $classroom->getId()));
    }
}