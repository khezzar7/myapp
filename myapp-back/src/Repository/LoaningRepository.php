<?php

namespace App\Repository;

use App\Entity\Loaning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Loaning|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loaning|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loaning[]    findAll()
 * @method Loaning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoaningRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Loaning::class);
    }

    public function findAllByPast()
    {
      $connection = $this-> getEntityManager()->getConnection();
      $sql=
      'SELECT * FROM loaning WHERE loaning.end < NOW()';
      $query=$connection->prepare($sql);
      $query->execute();
      return  $query->fetchAll();
    }
}
