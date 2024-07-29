<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findLatest($tag): array
    {

        $qb = $this->createQueryBuilder('product')
        ->addSelect('comments', 'tags')
        ->leftJoin('product.comments', 'comments')
        ->leftJoin('product.tags', 'tags')
        ->orderBy('product.id', 'DESC');

        if($tag){
            $qb->setParameter('tag', $tag)->andWhere(':tag MEMBER OF product.tags');
        }

        return $qb->getQuery()->getResult();
    }

      //  dd('llegamos al metodo ');
      //createQuery
      //Crear diferentes consultas
    // $dql = 'SELECT p FROM App\Entity\Product p ORDER BY p.id DESC';
    // $query = $this->getEntityManager()->createQuery( $dql)->setMaxResults(15);

    // $query = $this->createQueryBuilder('p')
    //     ->orderBy('p.id', 'DESC')
    //     ->setMaxResults(15)
    //     ->getQuery();


    // dd($query->getDQL());
    //PODEMOS AGREGAR CUALQUIER CONSULTA OFRECE MAYOR FLEXIBIILIDAD

       // return $query->getResult();

  //  }

    // public function findByTag($tag): array
    // {

    //     return $this->createQueryBuilder('product')

    //         ->setParameter('tag', $tag)
    //         ->andWhere(':tag MEMBER OF product.tags')


    //         ->addSelect('comments', 'tags')
    //         ->leftJoin('product.comments', 'comments')
    //         ->leftJoin('product.tags', 'tags')
    //         ->orderBy('product.id', 'DESC')
    //         ->getQuery()
    //         ->getResult();
    // }




//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
