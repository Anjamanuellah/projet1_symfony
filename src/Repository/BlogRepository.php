<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Blog>
 *
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function add(Blog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Blog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Blog[] Returns an array of Blog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Blog
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

/*
    public function findByDescription($description, $title)
    {
        $query = $this->createQueryBuilder('b');
        $query->where('b.description like :description' || 'b.description like :description');
        return $query->setParameter('description','%'.$description.'%')
                     ->setParameter('title','%'.$title.'%')
                     
                     ->getQuery()
                     ->getResult();
 
    }
*/
    public function findOneById($title, $description )
    {
        $query = $this->createQueryBuilder('b');
        return $query->where('b.title like :title')
                     ->andWhere('b.description like :description')
                     ->setParameter('title','%'.$title.'%')
                     ->setParameter('description','%'.$description.'%')
                     ->getQuery()
                     ->getResult();
 
    }

}
