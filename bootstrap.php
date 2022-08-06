<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";


$isDevMode = true;
$proxyDir = null;
$cache = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/model"], $isDevMode, $proxyDir, null, $useSimpleAnnotationReader);
$config->setResultCache($cache);


$connectionParams = [
	'dbname' => 'tienda',
	'user' => 'root',
	'password' => 'manager',
	'host' => 'localhost',
	'driver' => 'pdo_mysql',
];
$em = EntityManager::create($connectionParams, $config);