<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\Competency;
use AppBundle\Entity\LearningCard;
use AppBundle\Entity\LearningCardTemplate;
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
        $teachers = $this->loadTeachers($userManager);
        $students = $this->loadStudents($userManager);
        
        $this->loadClassrooms($manager, $students, $teachers);
    }

    private function loadTeachers(UserManager $manager)
    {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass('AppBundle\Entity\Teacher');

        $teachers = array();
        for ($i = 0; $i < 3; $i++) {
            $teacher = $manager->createUser();
            $teacher->setFirstName(sprintf('Teacher %d', $i));
            $teacher->setLastName('Surname');
            $teacher->setUsername(uniqid());
            $teacher->setPlainPassword('password');
            $teacher->setEmail(sprintf('teacher%d@test.com', $i));
            $teacher->setEnabled(true);
            $teacher->setRoles(array('ROLE_TEACHER'));
            $manager->updateUser($teacher);
            
            $teachers[] = $teacher;
        }

        $discriminator->setClass('AppBundle\Entity\Student');

        
        return $teachers;
    }

    private function loadStudents(UserManager $manager)
    {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass('AppBundle\Entity\Student');

        $students = array();
        for ($i = 0; $i < 3; $i++) {
            $student = $manager->createUser();
            $student->setFirstName(sprintf('Student %d', $i));
            $student->setLastName('Surname');
            $student->setUsername(uniqid());
            $student->setPlainPassword('password');
            $student->setEmail(sprintf('student%d@test.com', $i));
            $student->setEnabled(true);
            $student->setRoles(array('ROLE_STUDENT'));
            $manager->updateUser($student);

            $students[] = $student;
        }

        return $students;
    }
    
    private function loadClassrooms(ObjectManager $manager, array $students, array $teachers)
    {
        $class1 = new Classroom();
        $class1->setName('Cricket');
        $class1->setTeacher($teachers[0]);

        $template1 = new LearningCardTemplate();
        $template1->addClassroom($class1);

        $comp1 = new Competency();
        $comp1->setTitle('Throwing');
        $comp1->setMinRange(1);
        $comp1->setMaxRange(10);
        $template1->addCompetency($comp1);

        $comp2 = new Competency();
        $comp2->setTitle('Catching');
        $comp2->setMinRange(1);
        $comp2->setMaxRange(10);
        $template1->addCompetency($comp2);

        $comp3 = new Competency();
        $comp3->setTitle('Defending');
        $comp3->setMinRange(1);
        $comp3->setMaxRange(10);
        $template1->addCompetency($comp3);

        $class1->setLearningCardTemplate($template1);

        foreach($students as $student) {
            $learningCard = new LearningCard();
            $learningCard->setStudent($student);
            $class1->addStudent($student);
        }

        $manager->persist($comp1);
        $manager->persist($comp2);
        $manager->persist($comp3);
        $manager->persist($template1);
        $manager->persist($class1);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
