<?php

namespace AppBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

/**
 * Feature context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

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
     * @Given /^there are the following users:$/
     */
    public function thereAreTheFollowingUsers(TableNode $table)
    {
        $userManager = $this->kernel->getContainer()->get('fos_user.user_manager');

        foreach ($table->getHash() as $hash) {
            $user = $userManager->createUser();
            $user->setName($hash['name']);
            $user->setUsername($hash['username']);
            $user->setPlainPassword($hash['password']);
            $user->setEmail($hash['email']);
            $user->setEnabled(true);
            $userManager->updateUser($user);
        }
    }

    /**
     * @Given /^the database is clean$/
     */
    public function theDatabaseIsClean()
    {
        $em = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
        $em->createQuery('DELETE AppBundle:User')->execute();
        $em->flush();
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
     * @Given /^there is the following activity:$/
     */
    public function thereIsTheFollowingActivity(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^it has the following competencies:$/
     */
    public function itHasTheFollowingCompetencies(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^all competencies have a grade of "([^"]*)"$/
     */
    public function allCompetenciesHaveAGradeOf($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I am logged in as a "([^"]*)"$/
     */
    public function iAmLoggedInAsA($arg1)
    {
        throw new PendingException();
    }
}
