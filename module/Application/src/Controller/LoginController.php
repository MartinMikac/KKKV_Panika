<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Description of LoginController
 * 
 * modul pro zajištění přihlášení uživatelů
 *
 * @author martin.mikac
 */
class LoginController extends AbstractActionController {

    public function indexAction() {


        //nastavení Layoutu pro přihlašování
        $this->layout('layout/login');

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {

            // Retrieve form data from POST variables
            $data = $this->params()->fromPost();
            $data = $this->params()->fromPost();

            // ... Do something with the data ...
            var_dump($data);
            
            var_dump("INDEX!!!!");
            return new ViewModel();
        }
    }

    public function prihlaseniAction() {


        //nastavení Layoutu pro přihlašování
        $this->layout('layout/login');

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Retrieve form data from POST variables
            $data = $this->params()->fromPost();

            // ... Do something with the data ...
            var_dump($data);
            
            return new ViewModel();
        }
    }

}
