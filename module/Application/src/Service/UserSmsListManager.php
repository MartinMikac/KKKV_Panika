<?php

namespace Application\Service;

//use Zend\ServiceManager\ServiceManager;
//use Zend\ServiceManager\ServiceManagerAwareInterface;
//use Application\Entity\Admin;
//use Zend\Filter\StaticFilter;
//use User\Entity\User;
use Application\Entity\UserSmsList;

/**
 * The UserSmsListManager service is responsible for save settings, updating existing
 */
class UserSmsListManager {

    /**
     * Entity manager.
     * @var $entityManager Doctrine\ORM\EntityManager;
     */
    /* @var $entityManager Doctrine\ORM\EntityManager; */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * This method adds a new smsUser
     * 
     */
    public function createSmsUserSetting($data) {
        $smsUser = new UserSmsList();

        $smsUser->setCeleJmeno($data['cele_jmeno']);
        $smsUser->setTelefon($data['telefon']);
        $smsUser->setOddeleni($data['oddeleni']);
        $smsUser->setEmail($data['email']);


        $this->entityManager->persist($smsUser);
        // Apply changes to database.
        $this->entityManager->flush();
    }
    

    /**
     * This method adds a new smsUser
     * 
     */
    public function updateSmsUser($id, $data) {
        
        /* @var $userSms \Application\Entity\UserSmsList */
        $userSms = $this->entityManager->getRepository(UserSmsList::class)->findOneById($id);
        
        $userSms->setCeleJmeno($data['cele_jmeno']);
        $userSms->setTelefon($data['telefon']);
        $userSms->setOddeleni($data['oddeleni']);
        $userSms->setEmail($data['email']);


        $this->entityManager->persist($userSms);
        // Apply changes to database.
        $this->entityManager->flush();
    }    

    /**
     * This method adds a new smsUser
     * 
     */
    public function deleteSmsUser($id) {

        /* @var $user \User\Entity\User */
        $userSms = $this->entityManager->getRepository(UserSmsList::class)->findOneById($id);

        $this->entityManager->remove($userSms);

        $this->entityManager->flush();
    }

}
