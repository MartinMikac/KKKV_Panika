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

    /**
     * This method allows to update data of a single post.
     */
    public function updateAdmin(\Application\Entity\Setting $setting, $data) {


//        echo $data['id'];

        /* @var $user \User\Entity\User */
        $user = $this->entityManager->getRepository(User::class)->findOneById($data['id']);

        $setting->setCeleJmeno($data['cele_jmeno']);
        $setting->setUmisteni($data['umisteni']);
        //$setting->setEmail($data['email']);
        $setting->setTelefon($data['telefon']);


        $aktualni_datum = new \DateTime("now");
        $aktualni_datum->format('Y-m-d H:i:s');

        $setting->setLastOnline($aktualni_datum);






        if (strlen($data['heslo']) > 1) {

            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create($data['heslo']);

            $setting->setHeslo($passwordHash);
            //$user->setHeslo(password_hash($data['heslo'], PASSWORD_DEFAULT));
            $user->setPassword($passwordHash);
            $this->entityManager->persist($user);
        }

        $this->entityManager->flush();
    }

}
