<?php

namespace AppBundle\Controller\Teacher\Classes;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AllController extends Controller
{
    /**
     * @Route()
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}