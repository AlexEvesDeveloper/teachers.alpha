<?php

namespace AppBundle\Controller\Classroom;

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
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        return array();
    }
}