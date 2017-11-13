<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    /**
     * Je uživatel autorizován
     *
     * @var $isAuthorised type
     */
    public $isAuthorised = false;

    public function indexAction() {

        // pokud není autorizován pak přesměrovat na přihlášení
        if ($this->isAuthorised == false) {

            $vm = new ViewModel();

            $this->layout('layout/login');
            return §vm;
        } else {
            $vm = new ViewModel();
            return $vm;
        }
    }

}
