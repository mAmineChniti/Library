<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    /**
     * @return Author[] Returns an array of Author objects
     */
    public function ListAuthors(): array
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Author $author
     */
    public function AddAuthor(Author $author): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($author);
        $entityManager->flush();
    }
    /**
     * @param int $id
     **/
    public function DeleteAuthor(int $id): void
    {
        $entityManager = $this->getEntityManager();
        $author = $entityManager->getRepository(Author::class)->find($id);
        $entityManager->remove($author);
        $entityManager->flush();
    }
}
