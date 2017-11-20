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
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }    
    
    public function indexAction() {


        // Create form.
        //$form = new PostForm();
        $form = new NastaveniForm();
        
        
        // Get admin ID.
        //$postId = (int)$this->params()->fromRoute('id', -1);
        // todo: aktuálně hard settigns
        $adminId = 1;
        
        // Validate input parameter
        if ($adminId<0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        /* @var $adminRepository \Application\Repository\AdminRepository */
        $adminRepository = $this->entityManager->getRepository(Admin::class);
        
        /* @var $admin \Application\Entity\Admin */
        $admin = $adminRepository->NajdiAdminDleId(1); //->findOneByIdAdmins($adminId);      
        
        
        
        
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
                
                // Use post manager service update existing post.                
                $this->postManager->updatePost($post, $data);
                
                // Redirect the user to "admin" page.
                return $this->redirect()->toRoute('posts', ['action'=>'admin']);
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
