<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
//use Application\Entity\Online;
use Application\Entity\User;
use Application\Entity\Setting;
use User\Service\UserManager;
use Zend\Mail;
//use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

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
     * user manager.
     * @var $userManager User\Service\UserManager
     */
    private $userManager;

    /**
     * alert manager.
     * @var $alertManager Application\Service\AlertManager
     */
    private $alertManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager, $userManager, $alertManager) {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
        $this->alertManager = $alertManager;
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
        //$onlines = $this->entityManager->getRepository(Online::class)->NajdiOnline(1)->getResult();




        /* @var $userRepository \Application\Repository\UserRepository */
        $userRepository = $this->entityManager->getRepository(User::class);

        /* @var $user \Application\Entity\User */
        $userOnline = $userRepository->NajdiOnlineUsers();


        //$settingRepository->NajdiNastaveniDleIdUser($id_user);
        //$userOnline = $this->entityManager->getRepository(User::class)->GetOnlineUsers();
        //$vystup = $onlines->getSQL();
        //var_dump($onlines);
        //$kus = $this->entityManager->getRepository(Online::class)->findByIdOnline(1);
        //    $user = $this->entityManager->getRepository(User::class)
        //             ->findOneByEmail($this->identity());
        //echo $online;
        //var_dump($this->entityManager->getRepository(Online::class))->findAlll();
        //echo "</br></br></br>TEST";

        return new ViewModel([
            'onlines' => $userOnline
        ]);
        // Find the post by ID
    }

    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction() {
        $id = $this->params()->fromRoute('id');

        if ($id != null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }

        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if (!$this->access('profile.any.view') &&
                !$this->access('profile.own.view', ['user' => $user])) {
            return $this->redirect()->toRoute('not-authorized');
        }

        return new ViewModel([
            'user' => $user
        ]);
    }

    public function ajaxAction() {
        //$data = $this->bookTable->fetchAll();
        $request = $this->getRequest();
        $query = $request->getQuery();

        $user = $this->currentUser();

        if ($user != null) {


            /* @var $userManager \User\Service\UserManager */
            $userManager = $this->userManager;

            $userManager->setNewOnlineTime($user);

            /* @var $userRepository \Application\Repository\UserRepository */
            $userRepository = $this->entityManager->getRepository(User::class);

            /* @var $user \Application\Entity\User */
            $userOnline = $userRepository->NajdiOnlineUsersJson();
        } else {
            $this->getResponse()->setStatusCode(404);
            return;
        }


        if ($request->isXmlHttpRequest() || $query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            //
            //            foreach ($data as $sampledata) {
            $temp = array(
                'author' => "autor",
                'title' => "title",
                'imagepath' => "imagepath"
            );
            $jsonData[$idx++] = $temp;
            //            }

            $view = new JsonModel($userOnline);
            //$view = new JsonModel($jsonData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel();
        }
        return $view;
    }

    /**
     * The "ALERT" action displays the info about currently logged in user.
     */
    public function alertAction() {

        /* @var $user \User\Entity\User */
        $user = $this->currentUser();
        $id_user = $user->getId();



        /* @var $alertManager \Application\Service\AlertManager */
        $alertManager = $this->alertManager;
        $alertManager->addNewAlert($id_user);


        $mail = new Mail\Message();
        $mail->setBody('This is the text of the email.');
        $mail->setFrom('mikac@knihovnakv.cz', "Miki");
        $mail->addTo('mikac@knihovnakv.cz', "Miki");
        $mail->setSubject('TestSubject - PANIKA!');

        //$transport = new Mail\Transport\Sendmail();
        //$transport->send($mail);

        // Setup SMTP transport using LOGIN authentication
        $transport = new SmtpTransport();
        $options = new SmtpOptions([
            'name' => 'mail.knihovnakv.cz',
            'host' => '192.168.1.203',
            'connection_class' => 'login',
            'connection_config' => [
                'username' => 'mikac',
                'password' => 'Hellmaker007',
            ],
        ]);
        $transport->setOptions($options);
        $transport->send($mail);




        return $this->redirect()->toRoute('home');
    }

    /**
     * The "ALERT" action displays the info about currently logged in user.
     */
    public function panikaAction() {


        $view = new ViewModel();

        return $view;
    }

    /**
     * The "ALERT" action displays the info about currently logged in user.
     */
    public function alertOverAction() {

        $id = $this->params()->fromRoute('value');

        if ($id == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }



        /* @var $user \User\Entity\User */
        $user = $this->currentUser();
        $id_user = $user->getId();



        /* @var $alertManager \Application\Service\AlertManager */
        $alertManager = $this->alertManager;
        //$alertManager->addNewAlert($id_user);
        $alertManager->closeAlert($id_user, $id);

        return $this->redirect()->toRoute('home');
    }

    /**
     * The "ALERT" action displays the info about currently logged in user.
     */
    public function checkAlertAction() {

        $request = $this->getRequest();
        $query = $request->getQuery();

        if ($request->isXmlHttpRequest() || $query->get('showJson') == 1) {



            /* @var $userRepository \Application\Repository\UserRepository */
            $userRepository = $this->entityManager->getRepository(User::class);

            /* @var $user \Application\Entity\User */
            $alerts = $userRepository->NajdiAlertsUsersJson();



            $jsonData = array();
            $idx = 0;
            //
            //            foreach ($data as $sampledata) {
            $temp = array(
                'isAlert' => "true",
                'cele_jmeno' => "Novák",
                'umisteni' => "Čítárna",
                'telefon' => "723 027 278"
            );
            $jsonData[$idx++] = $temp;
            //            }
            $view = new JsonModel($alerts);
            //$view = new JsonModel($jsonData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel();
        }
        return $view;
    }

}
