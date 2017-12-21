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
            'onlines' => $onlines,
            //'kus' => $kus,
        ]);
        // Find the post by ID
    }

    
    public function aboutAction() {

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
            'onlines' => $onlines,
            //'kus' => $kus,
        ]);
        // Find the post by ID
    }
    
}
