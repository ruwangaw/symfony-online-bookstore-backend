<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository
{
    private $entityManager;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Books::class);
        $this->entityManager = $this->getEntityManager();
    }

    /**
     * @return Books[]
     */
    public function getAll()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $query = $queryBuilder->select('b, c')
            ->from('App\Entity\Books', 'b')
            ->join('b.category', 'c')->getQuery();
        return $query->getResult();
    }

    public function getBooks(int $id = null, string $isbn = null, string $title = null, string $categoryCode = null)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('b, c')
            ->from('App\Entity\Books', 'b')
            ->join('b.category', 'c');
        if ($id != null) {
            $queryBuilder->andwhere('b.id = :id')
                ->setParameter('id', $id);
        }
        if ($isbn != null) {
            $queryBuilder->andwhere('b.isbn = :isbn')
                ->setParameter('isbn', $isbn);
        }
        if ($title != null) {
            $queryBuilder->andwhere('b.title = :title')
                ->setParameter('title', $title);
        }
        if ($categoryCode != null) {
            $queryBuilder->andwhere('c.code = :code')
                ->setParameter('code', $categoryCode);
        }
        $query = $queryBuilder->getQuery();
        // var_dump($query->getSQL());die();
        return $query->getResult();
    }

    public function getBookById(int $id)
    {
        return $this->entityManager->getRepository("App\Entity\Books")->findOneBy(['id' => $id]);
    }

    public function getBooksByShoppingCartId(int $cartId)
    {        
        $sql = 'SELECT b,scb FROM App\Entity\ShoppingCartBooks scb JOIN scb.book b WHERE scb.book = b.id AND scb.shoppingCart = :cartId';

        $query = $this->entityManager->createQuery($sql);
        $query->setParameter('cartId', $cartId);

        return $query->getResult();
    }
}
