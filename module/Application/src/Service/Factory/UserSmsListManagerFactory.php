<?php
namespace Application\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\UserSmsListManager;

/**
 * This is the factory for AdminManager. Its purpose is to instantiate the
 * service.
 */
class UserSmsListManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        
        // Instantiate the service and inject dependencies
        
        return new UserSmsListManager($entityManager);
    }
}




