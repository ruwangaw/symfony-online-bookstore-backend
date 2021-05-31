<?php

namespace App\Repository;

use App\Entity\MstBookCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MstBookCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method MstBookCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method MstBookCategories[]    findAll()
 * @method MstBookCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MstBookCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MstBookCategories::class);
    }

    public function findAll(){
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $query = $queryBuilder->select('c')
            ->from('App\Entity\MstBookCategories', 'c')->getQuery();
        return $query->getResult();
    }
    // /**
    //  * @return MstBookCategories[] Returns an array of MstBookCategories objects
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
    public function findOneBySomeField($value): ?MstBookCategories
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
