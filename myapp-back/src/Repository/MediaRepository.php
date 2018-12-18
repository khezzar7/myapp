<?php

namespace App\Repository;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Media|null find($id, $lockMode = null, $lockVersion = null)
 * @method Media|null findOneBy(array $criteria, array $orderBy = null)
 * @method Media[]    findAll()
 * @method Media[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Media::class);
    }

    public function findByAssoc(){
      $connection = $this->getEntityManager()->getConnection();
      $sql=
      'SELECT
      media.id,
      media.title,
      media.type,
      media.author,
      loaning.start,
      loaning.end,
      loaning.user
      FROM media
      LEFT JOIN loaning ON loaning.media_id = media.id
      WHERE loaning.end >= NOW()
      OR loaning.end IS NULL';
      $query=$connection->prepare($sql);
      $query->execute();
      return  $query->fetchAll();

    }

    
}
