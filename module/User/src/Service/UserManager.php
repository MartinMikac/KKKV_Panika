<?php
namespace User\Service;

use User\Entity\User;
use User\Entity\Role;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class UserManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;  
    
    /**
     * Role manager.
     * @var User\Service\RoleManager
     */
    private $roleManager;
    
    /**
     * Permission manager.
     * @var User\Service\PermissionManager
     */
    private $permissionManager;
    
    /**
     * Constructs the service.
     */
    public function __construct($entityManager, $roleManager, $permissionManager) 
    {
        $this->entityManager = $entityManager;
        $this->roleManager = $roleManager;
        $this->permissionManager = $permissionManager;
    }
    
    /**
     * This method adds a new user.
     */
    public function addUser($data) 
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }
        
        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);        

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);        
        $user->setPassword($passwordHash);
        
        $user->setStatus($data['status']);
        
        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);        
        
        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);        
        
        // Add the entity to the entity manager.
        $this->entityManager->persist($user);
                       
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $user;
    }
    
    /**
     * This method updates data of an existing user.
     */
    public function updateUser($user, $data) 
    {
        // Do not allow to change user email if another user with such email already exits.
        if($user->getEmail()!=$data['email'] && $this->checkUserExists($data['email'])) {
            throw new \Exception("Another user with email address " . $data['email'] . " already exists");
        }
        
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);        
        $user->setStatus($data['status']); 
        
        // Assign roles to user.
        $this->assignRoles($user, $data['roles']);
        
        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
    
    /**
     * A helper method which assigns new roles to the user.
     */
    private function assignRoles($user, $roleIds)
    {
        // Remove old user role(s).
        $user->getRoles()->clear();
        
        // Assign new role(s).
        foreach ($roleIds as $roleId) {
            $role = $this->entityManager->getRepository(Role::class)
                    ->find($roleId);
            if ($role==null) {
                throw new \Exception('Not found role by ID');
            }
            
            $user->addRole($role);
        }
    }
    
    /**
     * This method checks if at least one user presents, and if not, creates 
     * 'Admin' user with email 'admin@example.com' and password 'Secur1ty'. 
     */
    public function createAdminUserIfNotExists()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);
        if ($user==null) {
            
            $this->permissionManager->createDefaultPermissionsIfNotExist();
            $this->roleManager->createDefaultRolesIfNotExist();
            
            $user = new User();
            $user->setEmail('admin@example.com');
            $user->setFullName('Admin');
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create('Secur1ty');        
            $user->setPassword($passwordHash);
            $user->setStatus(User::STATUS_ACTIVE);
            $user->setDateCreated(date('Y-m-d H:i:s'));
            
            // Assign user Administrator role
            $adminRole = $this->entityManager->getRepository(Role::class)
                    ->findOneByName('Administrator');
            if ($adminRole==null) {
                throw new \Exception('Administrator role doesn\'t exist');
            }

            $user->getRoles()->add($adminRole);
            
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }
    
    /**
     * Checks whether an active user with given email address already exists in the database.     
     */
    public function checkUserExists($email) {
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($email);
        
        return $user !== null;
    }
    
    /**
     * Checks that the given password is correct.
     */
    public function validatePassword($user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        
        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * Checks that the given password is correct.
     */
    public function setNewOnlineTime(\User\Entity\User $user) 
    {
        //$currentDate = date('Y-m-d H:i:s');
        
        $aktualni_datum = new \DateTime("now");
        $aktualni_datum->format('Y-m-d H:i:s');
        
        $user->setLastOnline($aktualni_datum);  
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
    }    
    
    /**
     * Generates a password reset token for the user. This token is then stored in database and 
     * sent to the user's E-mail address. When the user clicks the link in E-mail message, he is 
     * directed to the Set Password page.
     */
    public function generatePasswordResetToken($user)
    {
        // Generate a token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
        $user->setPasswordResetToken($token);
        
        $currentDate = date('Y-m-d H:i:s');
        $user->setPasswordResetTokenCreationDate($currentDate);  
        
        $this->entityManager->flush();
        
        $subject = 'Password Reset';
            
        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $passwordResetUrl = 'http://' . $httpHost . '/users/set-password?token=' . $token;
        
        $bodyMail = '<html><body>';
        $bodyMail = 'Prosím, klikněte na tento link pro reset hesla: </br>';
        $bodyMail .= "<a href=".$passwordResetUrl.">".$passwordResetUrl."</a>  </br>";
        $bodyMail .= "Pokud jste nechtěli heslo resetovat, pak tuto zprávu ignorujte. </br>";
        $bodyMail .= "</body></html>";
        
        // Send email to user.
        //mail($user->getEmail(), $subject, $body);
        
        
        
            $html = new MimePart($bodyMail);
            $html->type = Mime::TYPE_HTML;
            $html->charset = 'utf-8';
            $html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

            $body = new MimeMessage();
            $body->setParts([$html]);

            $message = new Message();
            $message->setBody($body);
            $message->setSubject("Nove heslo pro - panika.knihovnakv.cz");
            $message->setFrom('mikac@knihovnakv.cz', "Miki");
            $message->addTo($user->getEmail());
            
            $transport = new SmtpTransport();
            $options = new SmtpOptions([
                'name' => 'mail.knihovnakv.cz',
                'host' => '192.168.1.203'
            ]);
            $transport->setOptions($options);            

            //$contentTypeHeader = $message->getHeaders()->get('Content-Type');
            //$contentTypeHeader->setType('multipart/related');        
        
            $transport->send($message);
        
        /*
                $mail = new Mail\Message();
                //$mail->setBody($body);
                $mail->setFrom('mikac@knihovnakv.cz', "Miki");
                $mail->addTo($user->getEmail());
                $mail->setSubject('Vyresetovaní hesla - panika.knihovnakv.cz');

                $bodyPart = new \Zend\Mime\Message();
                $bodyMessage = new \Zend\Mime\Part($body);
                $bodyMessage->type = 'text/html';
                $bodyPart->setParts(array($bodyMessage));

                $mail->setBody($bodyPart);
                $mail->setEncoding('UTF-8');
                
                $transport = new SmtpTransport();
                $options = new SmtpOptions([
                    'name' => 'mail.knihovnakv.cz',
                    'host' => '192.168.1.203'
                ]);
                $transport->setOptions($options);
                $transport->send($mail);
         */
        
    }
    
    /**
     * Checks whether the given password reset token is a valid one.
     */
    public function validatePasswordResetToken($passwordResetToken)
    {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);
        
        if($user==null) {
            return false;
        }
        
        $tokenCreationDate = $user->getPasswordResetTokenCreationDate();
        $tokenCreationDate = strtotime($tokenCreationDate);
        
        $currentDate = strtotime('now');
        
        if ($currentDate - $tokenCreationDate > 24*60*60) {
            return false; // expired
        }
        
        return true;
    }
    
    /**
     * This method sets new password by password reset token.
     */
    public function setNewPasswordByToken($passwordResetToken, $newPassword)
    {
        if (!$this->validatePasswordResetToken($passwordResetToken)) {
           return false; 
        }
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);
        
        if ($user===null) {
            return false;
        }
                
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);        
        $user->setPassword($passwordHash);
                
        // Remove password reset token
        $user->setPasswordResetToken(null);
        $user->setPasswordResetTokenCreationDate(null);
        
        $this->entityManager->flush();
        
        return true;
    }
    
    /**
     * This method is used to change the password for the given user. To change the password,
     * one must know the old password.
     */
    public function changePassword($user, $data)
    {
        $oldPassword = $data['old_password'];
        
        // Check that old password is correct
        if (!$this->validatePassword($user, $oldPassword)) {
            return false;
        }                
        
        $newPassword = $data['new_password'];
        
        // Check password length
        if (strlen($newPassword)<6 || strlen($newPassword)>64) {
            return false;
        }
        
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);
        
        // Apply changes
        $this->entityManager->flush();

        return true;
    }
}

