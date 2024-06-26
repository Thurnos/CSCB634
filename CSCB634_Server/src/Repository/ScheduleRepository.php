<?php

namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Schedule>
 */
class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    //    /**
    //     * @return Schedule[] Returns an array of Schedule objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Schedule
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByStudentId(int $studentId): Schedule
    {
        return $this->createQueryBuilder('s')
            ->where('s.student_id = :studentId')
            ->setParameter('studentId', $studentId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByTeacherId(int $teacherId): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.teacher_id = :teacherId')
            ->setParameter('teacherId', $teacherId)
            ->getQuery()
            ->getResult();
    }

    public function findBySchoolId(int $schoolId): array
    {
        return $this->createQueryBuilder('s')
        ->where('s.school_id = :schoolId')
        ->setParameter('schoolId', $schoolId)
        ->getQuery()
        ->getResult();
    }
}
