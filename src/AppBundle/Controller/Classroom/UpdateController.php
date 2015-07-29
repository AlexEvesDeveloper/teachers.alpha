<?php

namespace AppBundle\Controller\Classroom;

use AppBundle\Entity\Classroom;
use AppBundle\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class UpdateController extends Controller
{
    /**
     * @Route("/classrooms/update/{id}")
     * @Method({"GET", "POST"})
     * @Template("Classroom\Update\index.html.twig")
     * @ParamConverter("classroom", class="AppBundle:Classroom")
     *
     * @param Classroom $classroom
     * @return array
     */
    public function indexAction(Request $request, Classroom $classroom)
    {
        $form = $this->createForm(new ClassroomType(), $classroom);
        $form->bind($request);

        if ($form->isValid()) {
            $classroom->setTeacher($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
        }
    }
}