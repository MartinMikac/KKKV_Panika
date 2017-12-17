<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\NastaveniController;
use Application\Service\AdminManager;

/**
 * This is the factory for NastaveniController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class NastaveniControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $adminManager = $container->get(AdminManager::class);
        
        // Instantiate the controller and inject dependencies
        return new NastaveniController($entityManager, $adminManager);        
        
    }
}