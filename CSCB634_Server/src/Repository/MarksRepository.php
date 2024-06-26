<?php

namespace App\Repository;

use App\Entity\Marks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Marks>
 */
class MarksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marks::class);
    }

    //    /**
    //     * @return Marks[] Returns an array of Marks objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Marks
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByStudentId(int $studentId): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.student_id = :studentId')
            ->setParameter('studentId', $studentId)
            ->getQuery()
            ->getResult();
    }
    public function findBySchoolId(int $schoolId): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.school_id = :schoolId')
            ->setParameter('schoolId', $schoolId)
            ->getQuery()
            ->getResult();
    }
    public function findBySubjectId(int $subjectId): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.subject_id = :studentId')
            ->setParameter('studentId', $subjectId)
            ->getQuery()
            ->getResult();
    }
}
