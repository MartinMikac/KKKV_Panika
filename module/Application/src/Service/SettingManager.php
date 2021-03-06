<?php

namespace Application\Service;

//use Zend\ServiceManager\ServiceManager;
//use Zend\ServiceManager\ServiceManagerAwareInterface;
//use Application\Entity\Admin;
//use Zend\Filter\StaticFilter;
use User\Entity\User;
use Application\Entity\Setting;
use Zend\Crypt\Password\Bcrypt;

/**
 * The AdminManager service is responsible for save settings, updating existing
 */
class SettingManager {

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
     * @var $user User\Entity\User
     */
    public function createDefaultSetting($user) {

        /* @var $userData \User\Entity\User */
        $userData = $user;

        $setting = new Setting();
        $setting->setUserId($userData->getId());
        $setting->setCeleJmeno("Nenastaveno");
        $setting->setTelefon("Nenastaveno");
        $setting->setUmisteni("Nenastaveno");
        $setting->setUser($user);
        $setting->setEmail($userData->getEmail());

        $aktualni_datum = new \DateTime("now");
        $aktualni_datum->format('Y-m-d H:i:s');

        $setting->setLastOnline($aktualni_datum);


        $this->entityManager->persist($setting);
        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * This method allows to update data of a single post.
     */
    public function updateAdmin(\Application\Entity\Setting $setting, $data) {

        /* @var $user \User\Entity\User */
        $user = $this->entityManager->getRepository(User::class)->findOneById($data['id']);

        $setting->setCeleJmeno($data['cele_jmeno']);
        $setting->setUmisteni($data['umisteni']);
        //$setting->setEmail($data['email']);
        $setting->setTelefon($data['telefon']);

        $aktualni_datum = new \DateTime("now");
        $aktualni_datum->format('Y-m-d H:i:s');
        $setting->setLastOnline($aktualni_datum);
        
        $this->entityManager->flush();

        if (strlen($data['heslo']) > 1) {
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create($data['heslo']);
            $user->setPassword($passwordHash);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }

}
