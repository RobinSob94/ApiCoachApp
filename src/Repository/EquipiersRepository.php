<?php

namespace App\Repository;

use App\Entity\Equipiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Equipiers>
 *
 * @method Equipiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipiers[]    findAll()
 * @method Equipiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipiers::class);
    }

//    /**
//     * @return Equipiers[] Returns an array of Equipiers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Equipiers
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
