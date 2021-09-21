<?php

namespace App\Repository;

use App\Entity\ModelIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModelIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelIngredient[]    findAll()
 * @method ModelIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelIngredient::class);
    }

    // /**
    //  * @return ModelIngredient[] Returns an array of ModelIngredient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModelIngredient
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
