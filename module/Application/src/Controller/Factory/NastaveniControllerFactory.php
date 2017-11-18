<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\NastaveniController;

/**
 * This is the factory for NastaveniController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class NastaveniControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        
        //$container->ge
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        ///var_dump($entityManager);
        // Instantiate the controller and inject dependencies
        return new NastaveniController($entityManager);
    }
}