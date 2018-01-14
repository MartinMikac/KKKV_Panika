<?php

/*
 * Zdrojový kód pouze pro interní potřebu Krajské knihovny Karlovy Vary.
 * @ Martin Mikač - 2017  * 
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\NastaveniForm;
use Application\Form\SmsUserForm;
use Application\Entity\Setting;
use Application\Entity\User;
use Application\Entity\UserSmsList;

/**
 * Description of NastaveniController
 *
 * @author miki
 */
class SettingController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Setting manager.
     * @var $settingManager \Application\Service\SettingManager
     */
    private $settingManager;

    /**
     * UserSmsList manager.
     * @var $userSmsListManager \Application\Service\UserSmsListManager
     */
    private $userSmsListManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager, $settingManager, $userSmsListManager) {
        $this->entityManager = $entityManager;
        $this->settingManager = $settingManager;
        $this->userSmsListManager = $userSmsListManager;

        //$settingManager->
    }

    public function indexAction() {

        $form = new NastaveniForm();

        // Get admin ID.
        $adminId = $this->params()->fromRoute('id');
        $user = null;


        if ($adminId != null) {


            /* @var $user \User\Entity\User */
            $user = $this->entityManager->getRepository(User::class)->findOneById($adminId);

            if ($user == null) {
                $this->getResponse()->setStatusCode(404);
                return;
            }

            /* @var $settingRepository \Application\Repository\SettingRepository */
            $settingRepository = $this->entityManager->getRepository(Setting::class);

            /* @var $setting \Application\Entity\Setting */
            $setting = $settingRepository->NajdiNastaveniDleIdUser($adminId);
        } else {

            /* @var $user \User\Entity\User */
            $user = $this->currentUser();
            $id_user = $user->getId();

            /* @var $user \Application\Entity\User */
            $user = $this->entityManager->getRepository(User::class)->findOneById($id_user);

            if ($user == null) {
                $this->getResponse()->setStatusCode(404);
                return;
            }

            /* @var $settingRepository \Application\Repository\SettingRepository */
            $settingRepository = $this->entityManager->getRepository(Setting::class);

            /* @var $setting \Application\Entity\Setting */
            $setting = $settingRepository->NajdiNastaveniDleIdUser($id_user);

            if ($setting == null) {
                /* @var $settingManager \Application\Service\SettingManager */
                $settingManager = $this->settingManager;
                $settingManager->createDefaultSetting($user);
            }


            /* @var $setting \Application\Entity\Setting */
            $setting = $settingRepository->NajdiNastaveniDleIdUser($id_user);
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
                $data['id'] = $setting->getId();
                // Use Online manager service update logged user.
                $this->settingManager->updateAdmin($setting, $data);

                // Redirect the user to "admin" page.
                return $this->redirect()->toRoute('nastaveni', ['action' => 'index']);
            } else {
                /* echo "NEVALIDNI";
                  print_r($form->getMessages()); //error messages
                  print_r($form->getErrors()); //error codes
                  print_r($form->getErrorMessages()); //any custom error messages
                 */
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

    public function smsUsersAction() {

        $userSmsList = $this->entityManager->getRepository(UserSmsList::class)->findAll();

        $this->flashMessenger()->addSuccessMessage('Un message de réussite');
        $this->flashMessenger()->addErrorMessage('Erreur avec le système.');
        $this->flashMessenger()->addInfoMessage('Info message');
        $this->flashMessenger()->addWarningMessage('Message d\'avertissement.');
        
         
        return new ViewModel([
            'onlines' => $userSmsList
        ]);
    }

    public function pridejSmsUserAction() {

        $form = new SmsUserForm();

        // Get admin ID.
        $userSmsId = $this->params()->fromRoute('id');


        if ($this->getRequest()->isPost()) {
            // Get POST data.
            $data = $this->params()->fromPost();

            $form->setData($data);
            if ($form->isValid()) {

                // Get validated form data.
                $data = $form->getData();

                /* @var $userSmsListManager \Application\Service\UserSmsListManager */
                $userSmsListManager = $this->userSmsListManager;
                $userSmsListManager->createSmsUserSetting($data);

                return $this->redirect()->toRoute('smsUsers');
            }




            //return $this->redirect()->toRoute('smsUsers');
        }

        return new ViewModel([
            'form' => $form
        ]);

        //return $this->redirect()->toRoute('smsUsers');
    }

    public function smazSmsUserAction() {

        // Get admin ID.
        $userSmsId = $this->params()->fromRoute('id');

        /* @var $userSmsListManager \Application\Service\UserSmsListManager */
        $userSmsListManager = $this->userSmsListManager;
        $userSmsListManager->deleteSmsUser($userSmsId);

        return $this->redirect()->toRoute('smsUsers');
    }

    public function upravSmsUserAction() {

        $form = new SmsUserForm();
        // Get admin ID.
        $userSmsId = $this->params()->fromRoute('id');

        /* @var $userSms \Application\Entity\UserSmsList */
        $userSms = $this->entityManager->getRepository(UserSmsList::class)->findOneById($userSmsId);

        if ($this->getRequest()->isPost()) {
            // Get POST data.
            $data = $this->params()->fromPost();

            $form->setData($data);
            if ($form->isValid()) {

                // Get validated form data.
                $data = $form->getData();

                /* @var $userSmsListManager \Application\Service\UserSmsListManager */
                $userSmsListManager = $this->userSmsListManager;
                $userSmsListManager->updateSmsUser($userSmsId, $data);
                //$userSmsListManager->createSmsUserSetting($data);
                
                $this->flashMessenger()->addSuccessMessage('změna uložena');

                return $this->redirect()->toRoute('smsUsers');
            }
        } else {
            $data = [
                'cele_jmeno' => $userSms->getCeleJmeno(),
                'email' => $userSms->getEmail(),
                'oddeleni' => $userSms->getOddeleni(),
                'telefon' => $userSms->getTelefon()
            ];

            $form->setData($data);
        }



        // Render the view template.
        return new ViewModel([
            'form' => $form
        ]);
        
    }

}
