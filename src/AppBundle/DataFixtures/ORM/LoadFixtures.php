<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PUGX\MultiUserBundle\Doctrine\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:
 *
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Alex Eves <alexevesdeveloper@gmail.com>
 */
class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('pugx_user_manager');
        $this->loadUsers($userManager);

        $this->loadClassrooms($manager);
    }

    private function loadUsers(UserManager $manager)
    {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');

        $discriminator->setClass('AppBundle\Entity\Teacher');
        $nathanTeacher = $manager->createUser();
        $nathanTeacher->setFirstName('Nathan');
        $nathanTeacher->setLastName('Teacher');
        $nathanTeacher->setUsername(uniqid());
        $nathanTeacher->setPlainPassword('password');
        $nathanTeacher->setEmail('nathan@test.com');
        $nathanTeacher->setEnabled(true);
        $nathanTeacher->setRoles(array('ROLE_TEACHER'));
        $manager->updateUser($nathanTeacher);

        $discriminator->setClass('AppBundle\Entity\Student');
        $alexTeacher = $manager->createUser();
        $alexTeacher->setFirstName('Alex');
        $alexTeacher->setLastName('Student');
        $alexTeacher->setUsername(uniqid());
        $alexTeacher->setPlainPassword('password');
        $alexTeacher->setEmail('alex@test.com');
        $alexTeacher->setEnabled(true);
        $alexTeacher->setRoles(array('ROLE_STUDENT'));
        $manager->updateUser($alexTeacher);
    }

    private function loadClassrooms(ObjectManager $manager)
    {

    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
