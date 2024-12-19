<?php

namespace App\Repository;

use App\Entity\Activite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Twilio\Rest\Client;

/**
 * @extends ServiceEntityRepository<Activite>
 *
 * @method Activite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activite[]    findAll()
 * @method Activite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activite::class);
    }

    public function save(Activite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Activite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Activite[] Returns an array of Activite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Activite
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function TriParNomActivite()
{
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery('SELECT p FROM App\Entity\Activite p ORDER BY p.nomAcitivite ASC');
    return $query->getResult();
}

public function TriParDateActivite()
{
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery('SELECT p FROM App\Entity\Activite p ORDER BY p.DateActivite DESC');
    return $query->getResult();
}

public function TriParNbrePlaceActivite()
{
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery('SELECT p FROM App\Entity\Activite p ORDER BY p.nbrePlace ASC');
    return $query->getResult();
}

public function Affichage()
{
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery("SELECT p FROM App\Entity\Activite p WHERE p.DateActivite>=CURRENT_DATE()");
    return $query->getResult();
}


}
