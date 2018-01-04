<?php

namespace Application\Service;

//use Zend\ServiceManager\ServiceManager;
//use Zend\ServiceManager\ServiceManagerAwareInterface;
//use Application\Entity\Admin;
//use Zend\Filter\StaticFilter;
//use User\Entity\User;
use Application\Entity\User;
use Application\Entity\Setting;
use Application\Entity\Alert;

/**
 * The AlertManager service is responsible for save alerts, updating existing alerts
 */
class AlertManager {

    /**
     * Entity manager.
     * @var $entityManager Doctrine\ORM\EntityManager;
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }
    
    
    /**
     * This method adds a new post.
     */
    public function closeAlert($user_id,$id_alert) {
        
        /* @var $user \User\Entity\User */
        $user = $this->entityManager->getRepository(User::class)->findOneById($user_id);
        
        /* @var $alert \Application\Entity\Alert */
        $alert = $this->entityManager->getRepository(Alert::class)->findOneById($id_alert);        
        
        $alert->setIsActive(false);

        $aktualni_datum = new \DateTime("now");
        $aktualni_datum->format('Y-m-d H:i:s');
        $alert->setCasKonec($aktualni_datum);
        $alert->setVyresil("Vyřešil id: ".$user->getId());

        // Add the entity to entity manager.
        $this->entityManager->persist($alert);

        // Apply changes to database.
        $this->entityManager->flush();
    }    

    /**
     * This method adds a new post.
     */
    public function addNewAlert($user_id) {

        
        /* @var $user \User\Entity\User */
        $user = $this->entityManager->getRepository(User::class)->findOneById($user_id);        
        
        $alert = new Alert();
        //$alert->setUserId($user_id);
        $alert->setUser($user);
        $alert->setIsActive(true);

        $aktualni_datum = new \DateTime("now");
        $aktualni_datum->format('Y-m-d H:i:s');
        $alert->setCasStart($aktualni_datum);

        // Add the entity to entity manager.
        $this->entityManager->persist($alert);

        // Apply changes to database.
        $this->entityManager->flush();
    }
}
