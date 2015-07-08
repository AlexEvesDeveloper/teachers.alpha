<?php

namespace AppBundle\Features\Context;

use AppBundle\Entity;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\Student;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Feature context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;
    private $authenticatedUser;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
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
     * @Given /^the database is clean$/
     */
    public function theDatabaseIsClean()
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
        $em->createQuery('DELETE AppBundle:Competency')->execute();
        $em->createQuery('DELETE AppBundle:Activity')->execute();
        $em->createQuery('DELETE AppBundle:User')->execute();
        $em->createQuery('DELETE AppBundle:Teacher')->execute();
        $em->createQuery('DELETE AppBundle:Student')->execute();
        $em->flush();
    }

    /**
     * @Given /^there are the following users:$/
     */
    public function thereAreTheFollowingUsers(TableNode $table)
    {
        $userManager = $this->kernel->getContainer()->get('fos_user.user_manager');

        foreach ($table->getHash() as $hash) {
            $class = sprintf('AppBundle\Entity\%s', $hash['type']);
            $user = new $class();
            $user->setName($hash['name']);
            $user->setUsername($hash['username']);
            $user->setPlainPassword($hash['password']);
            $user->setEmail($hash['email']);
            $user->setEnabled(true);
            $userManager->updateUser($user);
        }
    }

    /**
     * @Given /^I should be authenticated as [a|an] "([^"]*)"$/
     */
    public function iShouldBeAuthenticatedAsA($userType)
    {
        $expectedRole = $this->getRole($userType);

        $user = $this->kernel->getContainer()->get('security.token_storage')->getToken()->getUser();

        if ( ! in_array($expectedRole, $user->getRoles())) {
            throw new \LogicException(sprintf("User is not authenticated as a %s", $userType));
        }
    }

    private function getRole($userType)
    {
        switch (strtolower($userType)) {
            case 'administrator':
                return 'ROLE_ADMIN';
            case 'teacher':
                return 'ROLE_TEACHER';
            case 'student':
                return 'ROLE_STUDENT';
            default:
                return 'ROLE_USER';
        }
    }

    /**
     * @Given /^"([^"]*)" has a "([^"]*)" activity$/
     * @param $studentName
     * @param $activityName
     */
    public function hasAActivity($studentName, $activityName)
    {
        $doctrine = $this->kernel->getContainer()->get('doctrine');
        $em = $doctrine->getManager();
        $repo = $doctrine->getRepository('AppBundle:Student');

        // Fetch the Student.
        $student = $repo->findOneByName($studentName);

        // Create the Activity.
        $activity = $this->buildActivity($activityName, $student);

        // Connect the two.
        $student->addActivity($activity);
        $em->persist($student);
        $em->flush();
    }

    /**
     * @Given /^all "([^"]*)" competencies for "([^"]*)" have a grade of "([^"]*)"$/
     */
    public function allCompetenciesForHaveAGradeOf($activity, $student, $grade)
    {
        $doctrine = $this->kernel->getContainer()->get('doctrine');
        $em = $doctrine->getManager();

        // Get the Student.
        $student = $doctrine->getRepository('AppBundle:Student')->findOneByName($student);

        // Get the given activity that belongs to them.
        $activity = $doctrine->getRepository('AppBundle:Activity')->findOneBy(array('student' => $student, 'title' => $activity));

        // Update the grades.
        $competencies = $activity->getCompetencies();
        foreach ($competencies as $competency) {
            $competency->setCurrentGrade($grade);
            $competency->setActivity($activity);
            $em->persist($competency);
        }

        // Persist.
        $em->persist($activity);
        $em->persist($student);
        $em->flush();

    }

    /**
     * @Given /^I am logged in as a "([^"]*)"$/
     */
    public function iAmLoggedInAsA($username)
    {
        $driver = $this->getSession()->getDriver();
        if ( ! $driver instanceof BrowserKitDriver) {
            throw new UnsupportedDriverActionException('This step is only supported by the BrowserKitDriver', $driver);
        }

        $client = $driver->getClient();
        $client->getCookieJar()->set(new Cookie(session_name(), true));

        $session = $this->kernel->getContainer()->get('session');

        $user = $this->kernel->getContainer()->get('fos_user.user_manager')->findUserByUsername($username);
        if ( ! $user instanceof Entity\User) {
            throw new AccessDeniedException(sprintf('Could not find the user with username %s', $username));
        }

        $providerKey = $this->kernel->getContainer()->getParameter('fos_user.firewall_name');

        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
        $session->set('_security_'.$providerKey, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        $this->authenticatedUser = unserialize($session->get('_security_'.$providerKey))->getUser();
    }

    /**
     * @param $title
     * @param Student $student
     * @return Entity\Activity
     */
    private function buildActivity($title, Student $student)
    {
        $em = $this->kernel->getContainer()->get('doctrine')->getManager();
        $activity = new Entity\Activity();
        $activity->setTitle($title);
        $activity->setStudent($student);

        // Build and attach the default Competencies
        $this->attachCompetencies($activity);

        $em->persist($activity);
        $em->flush();

        return $activity;
    }

    /**
     * @param Entity\Activity $activity
     */
    private function attachCompetencies(Entity\Activity $activity)
    {
        switch ($activity->getTitle()) {
            case 'Basketball':
            case 'Football':
                $competencyList = array('Dribbling', 'Passing', 'Rebounding', 'Shooting', 'Defending', 'Gameplay', 'Tactics/Challenges');
                break;
            default:
                $competencyList = array();
        }

        $em = $this->kernel->getContainer()->get('doctrine')->getManager();

        if ( ! empty($competencyList)) {
            foreach ($competencyList as $competencyTitle) {
                $competency = new Entity\Competency();
                $competency->setTitle($competencyTitle);
                $em->persist($competency);

                $activity->addCompetency($competency);
                $em->persist($activity);
            }
        }

        $em->flush();
    }
}
