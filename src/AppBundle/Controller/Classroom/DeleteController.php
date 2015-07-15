<?php

namespace AppBundle\Controller\Classroom;

use AppBundle\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DeleteController extends Controller
{
    /**
     * @Route("/classrooms/delete/{id}")
     * @Method({"GET"})
     * @ParamConverter("classroom", class="AppBundle:Classroom")
     *
     * @param Classroom $classroom
     * @return array
     */
    public function indexAction(Classroom $classroom)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();

        return $this->redirectToRoute('app_classroom_list_index');
    }
}