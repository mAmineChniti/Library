<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function searchBookByRef($ref)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.authorID', 'a')->addSelect('a')->andWhere('b.id = :ref')
            ->setParameter('ref', $ref)
            ->getQuery()
            ->getResult();
    }
    public function booksListByAuthors()
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.authorID', 'a')
            ->addSelect('a')->orderBy('a.username', 'ASC')->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
