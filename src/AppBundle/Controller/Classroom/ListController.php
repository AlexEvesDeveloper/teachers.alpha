<?php

namespace AppBundle\Controller\Classroom;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/classrooms")
     * @Method({"GET", "POST"})
     * @Template("Classroom\List\index.html.twig")
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        return array();
    }
}