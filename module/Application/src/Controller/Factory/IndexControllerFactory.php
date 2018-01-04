<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\IndexController;
use User\Service\UserManager;
use Application\Service\AlertManager;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        
        //$container->ge
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $userManager = $container->get(UserManager::class);
        $alertManager = $container->get(AlertManager::class);

        ///var_dump($entityManager);
        // Instantiate the controller and inject dependencies
        return new IndexController($entityManager, $userManager,$alertManager);
    }
}