<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }
    
    /**
     * Requête pour retourner le nombre total de contacts
     * @param Contact $contact
     */
    public function nbContact()
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();    
    }

    /**
     * Requête pour retourner la dernière date de création
     * @param Contact $contact
     */
    public function lastDateModif()
    {
        return $this->createQueryBuilder('d')
            ->select('max(d.createdAt)')
            ->getQuery()
            ->getSingleScalarResult(); 
    }

    /**
     * Requête pour retourner les contact par leur première lettre
     * @param Contact $contact
     */
    public function findByFirstLetter(string $letter)
    {
        $query = $this->createQueryBuilder('g')
            ->where('g.name LIKE :letter')
            ->setParameter('letter' , '%'.$letter.'%')
            ->getQuery();
        return $query->getResult();            
    }


    // /**
    //  * @return Contact[] Returns an array of Contact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
