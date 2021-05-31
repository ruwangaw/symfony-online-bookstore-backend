<?php

namespace App\Repository;

use App\Entity\ShoppingCart;
use App\Entity\User;
use App\Entity\Books;
use App\Entity\BookDiscounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShoppingCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingCart[]    findAll()
 * @method ShoppingCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingCartRepository extends ServiceEntityRepository
{
    private $entityManager;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingCart::class);
        $this->entityManager = $this->getEntityManager();
    }

    // /**
    //  * @return ShoppingCart[] Returns an array of ShoppingCart objects
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
    public function findOneBySomeField($value): ?ShoppingCart
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(float $totalAmount, float $totalGrossAmount, float $discountAmount, User $user, string $createdAt)
    {
        $shoppingCart = new ShoppingCart();

        $shoppingCart->setTotalAmount($totalAmount);
        $shoppingCart->setGrossAmount($totalGrossAmount);
        $shoppingCart->setDiscountAmount($discountAmount);
        $shoppingCart->setUser($user);
        $shoppingCart->setCreatedAt($createdAt);

        $this->entityManager->persist($shoppingCart);
        $this->entityManager->flush();

        return $shoppingCart;
    }
}
