<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Online;

/**
 * This is the custom repository class for Post entity.
 */
class OnlineRepository extends EntityRepository
{
    /**
     * Retrieves all published posts in descending date order.
     * @return Query
     */
    public function findOnlines()
    {
        $entityManager = $this->getEntityManager();
        
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('p')
            ->from(Online::class, 'p');
        
        return $queryBuilder->getQuery();
    }
}