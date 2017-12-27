<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\NastaveniForm;
use Application\Entity\Setting;

/**
 * Description of NastaveniController
 *
 * @author miki
 */
class SettignController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Post manager.
     * @var Application\Service\AdminManager 
     */
    private $adminManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager, $adminManager) {
        $this->entityManager = $entityManager;
        $this->adminManager = $adminManager;
    }

    public function indexAction() {

        $form = new NastaveniForm();

        // Get admin ID.
        $adminId = $this->params()->fromRoute('id');


        if ($adminId != null) {

            /* @var $settingRepository \Application\Repository\SettignRepository */
            $settingRepository = $this->entityManager->getRepository(Settign::class);

            /* @var $admin \Application\Entity\Setting */
            $setting = $settingRepository->NajdiNastaveniDleIdUser($adminId); //->findOneByIdAdmins($adminId);      
        } else {
            
            /* @var $user \User\Entity\User */
            $user = $this->currentUser();
            
            /* @var $settignRepository \Application\Repository\SettignRepository */
            $settingRepository = $this->entityManager->getRepository(Setting::class);

            /* @var $admin \Application\Entity\Setting */
            $setting = $settingRepository->NajdiNastaveniDleIdUser($user->getId()); //->findOneByIdAdmins($adminId);                  
            
        }
        
        

        if ($setting == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }


        // Check whether this post is a POST request.
        // todo: dodělat test
        if ($this->getRequest()->isPost()) {

            // Get POST data.
            $data = $this->params()->fromPost();

            // Fill form with data.
            $form->setData($data);
            if ($form->isValid()) {

                // Get validated form data.
                $data = $form->getData();

                // Use Online manager service update logged user.
                //$this->postManager->updatePost($post, $data);
                $this->adminManager->updateAdmin($setting, $data);

                // Redirect the user to "admin" page.
                return $this->redirect()->toRoute('nastaveni', ['action' => 'index']);
            }
        } else {
            $data = [
                'cele_jmeno' => $setting->getCeleJmeno(),
                'email' => $setting->getEmail(),
                'heslo' => $setting->getHeslo(),
                'jmeno' => $setting->getJmeno(),
                'umisteni' => $setting->getUmisteni(),
                'telefon' => $setting->getTelefon(),
                'last_online' => $setting->getLastOnline()
            ];

            $form->setData($data);
        }

// Render the view template.
        return new ViewModel([
            'form' => $form,
            'admin' => $setting
        ]);
    }

}
