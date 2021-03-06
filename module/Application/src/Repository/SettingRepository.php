<?php

/* 
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Setting;

/**
 * This is the custom repository class for Post entity.
 */
class SettingRepository extends EntityRepository {

    /**
     * Retrieves setting for user
     * @return Query
     */
    public function NajdiNastaveniDleIdUser($id) {
        $entityManager = $this->getEntityManager();
        

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')
                ->from(Setting::class, 'p')
                ->where('p.user_id = :id_user')
                ->setParameter(':id_user',$id);
        
        
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }



}