<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\User;
use Application\Entity\Setting;
use Application\Entity\Alert;
use Doctrine\ORM\Query;

/**
 * This is the custom repository class for Post entity.
 */
class UserRepository extends EntityRepository {

    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */
    public function NajdiNastaveniDleIdUser($id) {
        $entityManager = $this->getEntityManager();


        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')
                ->from(Setting::class, 'p')
                ->where('p.id = :id_user')
                ->setParameter(':id_user', $id);


        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * Retrieves all users with last online is no more then 5 minutes
     * @return Query
     */
    public function NajdiOnlineUsers() {
        $entityManager = $this->getEntityManager();


        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p','t')
            ->from(Setting::class, 'p')
            ->join('p.user', 't')
            ->where('t.id = p.user_id')
            ->where('t.last_online > :datum')
            ->setParameter(':datum',new \DateTime('-5 minute'), \Doctrine\DBAL\Types\Type::DATETIME);
            
        $navrat = $queryBuilder->getQuery()->getResult(Query::HYDRATE_OBJECT);

        return $navrat;
    }

    
        /**
     * Retrieves all users with last online is no more then 5 minutes
     * @return Query
     */
    public function NajdiOnlineUsersJson() {
        $entityManager = $this->getEntityManager();


        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p','t')
            ->from(Setting::class, 'p')
            ->join('p.user', 't')
            ->where('t.id = p.user_id')
            ->where('t.last_online > :datum')
            ->setParameter(':datum',new \DateTime('-5 minute'), \Doctrine\DBAL\Types\Type::DATETIME);
            
        //$navrat = $queryBuilder->getQuery()->getResult(Query::HYDRATE_SCALAR)->exportTo('json');
        $navrat = $queryBuilder->getQuery()->getArrayResult();
        //$myArray = $query->getArrayResult();

        return $navrat;
    }
    
    
     /**
     * Retrieves all users with last online is no more then 5 minutes
     * @return Query
     */
    public function NajdiAlertsUsersJson() {
        $entityManager = $this->getEntityManager();


        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p','t','a')
            ->from(Setting::class, 'p')
            ->from(Alert::class, 'a')
            ->join('p.user', 't')
            ->where('t.id = p.user_id')
            ->where('t.id = a.user_id');
            //->where('t.last_online > :datum')
            //->setParameter(':datum',new \DateTime('-5 minute'), \Doctrine\DBAL\Types\Type::DATETIME);
            
        //$navrat = $queryBuilder->getQuery()->getResult(Query::HYDRATE_SCALAR)->exportTo('json');
        $navrat = $queryBuilder->getQuery()->getArrayResult();
        //$myArray = $query->getArrayResult();

        return $navrat;
    }    
}
