<?php

namespace AppBundle\Controller\Classroom;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\LearningCardTemplate;
use AppBundle\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class CreateController extends Controller
{
    /**
     * @Route("/classrooms/create")
     * @Method({"GET", "POST"})
     * @Template("Classroom\Create\index.html.twig")
     *
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $classroom = new Classroom();
        $form = $this->createForm(new ClassroomType(), $classroom);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $classroom->setTeacher($this->getUser());

            $template = new LearningCardTemplate();
            $classroom->setLearningCardTemplate($template);

            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();

            return $this->redirectToRoute('app_classroom_list_index');
        }

        return array(
            'form' => $form->createView()
        );
    }
}