<?php

/* 
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Nastaveni;

/**
 * This is the custom repository class for Post entity.
 */
class NastaveniRepository extends EntityRepository {

    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */
    public function NajdiNastaveniDleIdAdmin($id) {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')
                ->from(Admin::class, 'p')
                ->where('p.id_admins = :id_admin')
                ->setParameter(':id_admin',$id);
        
       
       
       

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

}