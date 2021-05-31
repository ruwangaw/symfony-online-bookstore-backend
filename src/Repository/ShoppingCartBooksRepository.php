<?php

namespace App\Repository;

use App\Entity\Books;
use App\Entity\ShoppingCart;
use App\Entity\ShoppingCartBooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShoppingCartBooks|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingCartBooks|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingCartBooks[]    findAll()
 * @method ShoppingCartBooks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingCartBooksRepository extends ServiceEntityRepository
{
    private $entityManager;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingCart::class);
        $this->entityManager = $this->getEntityManager();
    }

    // /**
    //  * @return ShoppingCartBooks[] Returns an array of ShoppingCartBooks objects
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
    public function findOneBySomeField($value): ?ShoppingCartBooks
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function save(ShoppingCart $shoppingCart, Books $book, int $bookCount, float $calculatedPrice = 0)
    {
        $shoppingCartBook = new ShoppingCartBooks();

        $shoppingCartBook->setShoppingCart($shoppingCart);
        $shoppingCartBook->setBook($book);
        $shoppingCartBook->setItemCount($bookCount);
        $shoppingCartBook->setCalculatedPrice($calculatedPrice);

        $this->entityManager->persist($shoppingCartBook);
        $this->entityManager->flush();

        return $shoppingCartBook;
    }
}
