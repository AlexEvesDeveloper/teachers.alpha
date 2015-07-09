<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ActivityRepository extends EntityRepository
{
    /**
     * @param Student $student
     * @param $activityTitle
     * @return array
     */
    public function findByStudentAndTitle(Student $student, $activityTitle)
    {
        print_r($student->getId());
        $query = "
            SELECT activity FROM AppBundle:Activity activity
            WHERE activity.student = :student
            AND activity.title = :activityTitle
        ";

        $params['student'] = $student;
        $params['activityTitle'] = $activityTitle;

        return $this->getEntityManager()->createQuery($query)->setParameters($params)->getOneOrNullResult();
    }
}