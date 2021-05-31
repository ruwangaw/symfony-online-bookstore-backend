<?php

namespace App\Repository;

use App\Entity\ShoppintCartDiscounts;
use App\Entity\BookDiscounts;
use App\Entity\ShoppingCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShoppintCartDiscounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppintCartDiscounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppintCartDiscounts[]    findAll()
 * @method ShoppintCartDiscounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppintCartDiscountsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppintCartDiscounts::class);
    }

    // /**
    //  * @return ShoppintCartDiscounts[] Returns an array of ShoppintCartDiscounts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShoppintCartDiscounts
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(BookDiscounts $discounts, ShoppingCart $shoppingCart){
        $shoppingCartDiscount = new ShoppintCartDiscounts();

        $shoppingCartDiscount->setDiscount($discounts);
        $shoppingCartDiscount->setShoppingCart($shoppingCart);

        $this->entityManager->persist( $shoppingCartDiscount);
        return  $this->entityManager->flush();
    }
}
