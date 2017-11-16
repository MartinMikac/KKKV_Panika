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
        if ($this->isAuthorised == false) {

            return $this->redirect()->toRoute('login', ['action' => 'index']);
        } else {

            $vm = new ViewModel();
            return $vm;
        }

        $online = $this->entityManager->getRepository(Online::class);
        //    $user = $this->entityManager->getRepository(User::class)
        //             ->findOneByEmail($this->identity());
        
    }

}
