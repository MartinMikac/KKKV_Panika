<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\SettingController;
use Application\Service\SettingManager;
use Application\Service\UserSmsListManager;

/**
 * This is the factory for NastaveniController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class SettingControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $settingManager = $container->get(SettingManager::class);
        $userSmsListManager = $container->get(UserSmsListManager::class);
        
        
        // Instantiate the controller and inject dependencies
        return new SettingController($entityManager, $settingManager,$userSmsListManager);        
        
    }
}