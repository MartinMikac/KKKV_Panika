<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."./module/"), $isDevMode);

//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);


// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);


// the connection configuration
$conn = array(
                    'driver' => 'pdo_mysql',
                    'host'     => '192.168.1.104',                    
                    'user'     => 'root',
                    'password' => 'toor',
                    'dbname'   => 'panika',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);