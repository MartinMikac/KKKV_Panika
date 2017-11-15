<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\LoginForm;
use Application\Entity\Online;


/**
 * Description of LoginController
 * 
 * modul pro zajištění přihlášení uživatelů
 *
 * @author martin.mikac
 */
class LoginController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
s     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {

        $user = $this->entityManager->getRepository(Online::class);
        
    }

    public function prihlaseniAction() {

        $formular = new LoginForm();
        //nastavení Layoutu pro přihlašování
        $this->layout('layout/login');

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Retrieve form data from POST variables
            $data = $this->params()->fromPost();

            // ... Do something with the data ...
//            var_dump($data);
        }

        // Pass form variable to view
        return new ViewModel([
            'form' => $formular
        ]);
    }

}
