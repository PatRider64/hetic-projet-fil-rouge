<?php

namespace App\Repository;

use App\Entity\MasterclassVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MasterclassVideo>
 *
 * @method MasterclassVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method MasterclassVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method MasterclassVideo[]    findAll()
 * @method MasterclassVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterclassVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterclassVideo::class);
    }

//    /**
//     * @return MasterclassVideo[] Returns an array of MasterclassVideo objects
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

//    public function findOneBySomeField($value): ?MasterclassVideo
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
