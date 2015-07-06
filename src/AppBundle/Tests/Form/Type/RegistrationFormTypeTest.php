<?php

namespace AppBundle\Tests\Form\Type;

use AppBundle\Entity\Teacher;
use AppBundle\Form\UserManagement\Type\RegistrationFormType;
use AppBundle\Tests\ContainerAwareUnitTestCase;
use Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\ConstraintViolationList;

class RegistrationFormTypeTest extends  ContainerAwareUnitTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $validator = $this->getMock('\Symfony\Component\Validator\Validator\ValidatorInterface');
        $validator->method('validate')->will($this->returnValue(new ConstraintViolationList()));

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->addTypeExtension(
                new FormTypeValidatorExtension(
                    $validator
                )
            )
            ->getFormFactory();
    }

    protected function getExtensions()
    {
        $mockRegistrationFormTypeParent = $this->getMockBuilder('FOS\UserBundle\Form\Type\RegistrationFormType')
            ->disableOriginalConstructor()
            ->setMethods(array('configureOptions'))
            ->getMock();

        $mockRegistrationFormTypeParent->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('fos_user_registration'));

        return array(new PreloadedExtension(array(
            $mockRegistrationFormTypeParent->getName() => $mockRegistrationFormTypeParent,
        ), array()));
    }

    public function testSubmitValidTeacher()
    {
        $formData = array(
            'username' => 'teacher',
            'plainPassword' => 'password',
            'email' => 'teacher@test.com',
            'name' => 'Teacher'
        );

        $type = $this->get('form.user_management.type.registration_form_type');
        $teacher = new Teacher();
        $form = $this->factory->create($type, $teacher);

        $testObject = $this->getTestObject($formData);
        $form->submit($formData);
        print_r($form->getData());
        print_r($testObject->getUsername());
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($testObject->getUsername(), $form->getData()->getUsername());
    }

    private function getTestObject(array $formData)
    {
        $teacher = new Teacher();
        $reflection = new \ReflectionClass($teacher);

        foreach ($formData as $property => $value) {
            $method = sprintf('set%s', ucfirst($property));
            if ($reflection->hasMethod($method)) {
                $teacher->{$method}($value);
            }
        }

        print_r($teacher);
        return $teacher;
    }
}