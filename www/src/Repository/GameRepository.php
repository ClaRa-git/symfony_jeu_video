<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    /**
     * Méthode pour récupérer un jeu par son id
     * @param int $id
     * @return array
     */
    public function getGameWithInfos(int $id): array
    {
        $entityManager = $this->getEntityManager();

        // // METHODE AVEC REQUETE SQL
        // // On crée la query
        // $query = $entityManager->createQuery('
        // SELECT 
        // g.id, 
        // g.title, 
        // g.description, 
        // g.price, 
        // g.releaseDate, 
        // g.imagePath ,
        // n.userNote,
        // n.mediaNote,
        // a.id as ageId,
        // a.label,
        // a.imagePath as pegi
        // FROM App\Entity\Game g
        // JOIN g.note n
        // JOIN g.age a
        // WHERE g.id = :id
        // ')->setParameter('id', $id);

        // METHODE AVEC DQL
        $qd = $entityManager->createQueryBuilder();
        // On crée la query
        $query = $qd->select('g.id, g.title, g.description, g.price, g.releaseDate, g.imagePath, n.userNote, n.mediaNote, a.id as ageId, a.label, a.imagePath as pegi')
            ->from('App\Entity\Game', 'g')
            ->join('g.note', 'n')
            ->join('g.age', 'a')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Méthode qui récupère les consoles liées à un jeu
     * @param int $id
     * @return array
     */
    public function getConsolesByGame(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'c.id',
            'c.label'
            ])->from(Game::class, 'g')
            ->join('g.consoles', 'c')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }
}
