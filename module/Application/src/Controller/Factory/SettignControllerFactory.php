<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\SettignController;
use Application\Service\SettignManager;

/**
 * This is the factory for NastaveniController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class SettignControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $settingManager = $container->get(SettignManager::class);
        
        // Instantiate the controller and inject dependencies
        return new SettignController($entityManager, $settingManager);        
        
    }
}