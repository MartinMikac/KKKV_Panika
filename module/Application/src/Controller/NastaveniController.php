<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\NastaveniForm;
use Application\Entity\Admin;

/**
 * Description of NastaveniController
 *
 * @author miki
 */
class NastaveniController extends AbstractActionController {

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

            /* @var $adminRepository \Application\Repository\AdminRepository */
            $adminRepository = $this->entityManager->getRepository(Admin::class);

            /* @var $admin \Application\Entity\Admin */
            $admin = $adminRepository->NajdiAdminDleId($adminId); //->findOneByIdAdmins($adminId);      
        } else {
            
            /* @var $user \User\Entity\User */
            $user = $this->currentUser();
            
            /* @var $adminRepository \Application\Repository\AdminRepository */
            $adminRepository = $this->entityManager->getRepository(Admin::class);

            /* @var $admin \Application\Entity\Admin */
            $admin = $adminRepository->NajdiAdminDleId($user->getId()); //->findOneByIdAdmins($adminId);      
        }
        
        

        if ($admin == null) {
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
                $this->adminManager->updateAdmin($admin, $data);

                // Redirect the user to "admin" page.
                return $this->redirect()->toRoute('nastaveni', ['action' => 'index']);
            }
        } else {
            $data = [
                'cele_jmeno' => $admin->getCeleJmeno(),
                'email' => $admin->getEmail(),
                'heslo' => $admin->getHeslo(),
                'jmeno' => $admin->getJmeno(),
                'umisteni' => $admin->getUmisteni(),
                'telefon' => $admin->getTelefon(),
                'last_online' => $admin->getLastOnline()
            ];

            $form->setData($data);
        }

// Render the view template.
        return new ViewModel([
            'form' => $form,
            'admin' => $admin
        ]);
    }

}
