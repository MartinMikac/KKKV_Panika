<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Admin;

/**
 * This is the custom repository class for Post entity.
 */
class AdminRepository extends EntityRepository {

    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */
    public function NajdiAdminDleId($id) {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')
                ->from(Admin::class, 'p')
                ->where('p.id_admins = :id_admin')
                ->setParameter(':id_admin',$id);
        
       
       
       

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

}
