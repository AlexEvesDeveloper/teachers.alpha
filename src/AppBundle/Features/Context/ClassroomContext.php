<?php

namespace AppBundle\Features\Context;

use AppBundle\Entity;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Feature context.
 */
class ClassroomContext extends RawMinkContext implements KernelAwareContext
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^there are the following classrooms:$/
     */
    public function thereAreTheFollowingClassrooms(TableNode $table)
    {
        $em = $this->kernel->getContainer()->get('doctrine')->getManager();

        foreach ($table->getHash() as $hash) {
            $classroom = new Entity\Classroom();
            $classroom->setName($hash['name']);
            $classroom->setTeacher($this->findTeacherEntity($hash['teacher']));

            $em->persist($classroom);
            $em->flush();
        }
    }

    private function findTeacherEntity($firstName)
    {
        $em = $this->kernel->getContainer()->get('doctrine');

        return $em->getRepository('AppBundle:Teacher')->findOneByFirstName($firstName);
    }

    /**
     * @Given /^the classroom "([^"]*)" does not have a template$/
     */
    public function theClassroomDoesNotHaveATemplate($classroom)
    {
        $doctrine = $this->kernel->getContainer()->get('doctrine');
        $em = $doctrine->getManager();

        // Get the Classroom.
        $classroom = $doctrine->getRepository('AppBundle:Classroom')->findOneByName($classroom);
        $classroom->setLearningCardTemplate(null);

        $em->persist($classroom);
        $em->flush();
    }
}

