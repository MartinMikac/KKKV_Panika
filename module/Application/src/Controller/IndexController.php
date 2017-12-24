<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Online;
use User\Entity\User;

class IndexController extends AbstractActionController {

    /**
     * Je uživatel autorizován
     *
     * @var $isAuthorised type
     */
    public $isAuthorised = true;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {

        // pokud není autorizován pak přesměrovat na přihlášení
        /*        if ($this->isAuthorised == false) {

          return $this->redirect()->toRoute('login', ['action' => 'index']);
          } else {

          $vm = new ViewModel();
          return $vm;
          }
         */

        //$entityManager = $container->get('doctrine.entitymanager.orm_default');   
        //$online = $entityManager->getRepository(Online::class)->findAll();
        //$onlines = $this->entityManager->getRepository(Online::class)->findAll();

        //$onlines = $this->entityManager->getRepository(Online::class)->findAllByStatus("normalni");
        
        
        $onlines = $this->entityManager->getRepository(Online::class)->NajdiOnline(1)->getResult();
        
        
        //$vystup = $onlines->getSQL();
        
        //var_dump($onlines);
        
        


        //$kus = $this->entityManager->getRepository(Online::class)->findByIdOnline(1);
        //    $user = $this->entityManager->getRepository(User::class)
        //             ->findOneByEmail($this->identity());
        //echo $online;
        //var_dump($this->entityManager->getRepository(Online::class))->findAlll();
        //echo "</br></br></br>TEST";

        return new ViewModel([
            'onlines' => $onlines
        ]);
        // Find the post by ID
    }
    
    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction()
    {
        $id = $this->params()->fromRoute('id');
        
        if ($id!=null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }
        
        if ($user==null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        if (!$this->access('profile.any.view') && 
            !$this->access('profile.own.view', ['user'=>$user])) {
            return $this->redirect()->toRoute('not-authorized');
        }
        
        return new ViewModel([
            'user' => $user
        ]);
    }    
    

}
