<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\KatalogController;

/**
 * This is the factory for katalogController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class KatalogControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        
        // Instantiate the controller and inject dependencies
        return new KatalogController($entityManager);        
        
    }
}