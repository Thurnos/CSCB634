<?php

namespace App\Repository;

use App\Entity\Students;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Students>
 */
class StudentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Students::class);
    }

    //    /**
    //     * @return Students[] Returns an array of Students objects
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

    //    public function findOneBySomeField($value): ?Students
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    /**
     * @param int $parentId
     * @return Students[]
     */
    public function findByParentId(int $parentId): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s FROM App\Entity\Students s
            WHERE JSON_CONTAINS(s.parent_ids, :parentId) = 1'
        )->setParameter('parentId', $parentId);

        return $query->getResult();
    }

    public function findBySchoolId(int $schoolId): array
    {
        return $this->createQueryBuilder('s')
        ->where('s.school_id = :schoolId')
        ->setParameter('schoolId', $schoolId)
        ->getQuery()
        ->getResult();
    }

    public function findByEmail(string $email): Students
    {
        return $this->createQueryBuilder('s')
            ->where('s.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
