<?php

namespace Application\Service;

//use Zend\ServiceManager\ServiceManager;
//use Zend\ServiceManager\ServiceManagerAwareInterface;
//use Application\Entity\Admin;
//use Zend\Filter\StaticFilter;

/**
 * The AdminManager service is responsible for save settigns, updating existing
 */
class SettignManager {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
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
    public function addNewPost($data) {
        // Create new Post entity.
        $post = new Post();
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setStatus($data['status']);
        
        $post->setDateCreated($currentDate);

        // Add the entity to entity manager.
        $this->entityManager->persist($post);

        // Add tags to post
        $this->addTagsToPost($data['tags'], $post);

        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * This method allows to update data of a single post.
     */
    public function updateAdmin(\Application\Entity\Settign $settign, $data) {

        $settign->setCeleJmeno($data['cele_jmeno']);
        $settign->setUmisteni($data['umisteni']);
        $settign->setEmail($data['email']);
        $settign->setTelefon($data['telefon']);
        
        //$admin->setLastOnline(date('Y-m-d H:i:s'));
        
        

        if (strlen($data['heslo']) > 1) {
            $settign->setHeslo(password_hash($data['heslo'], PASSWORD_DEFAULT));
        }

        $this->entityManager->flush();
    }

}
