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

            $vm = new ViewModel();
            $this->layout('layout/login');
            
            
    }

}
