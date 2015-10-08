<?php

require_once __DIR__ . '/doctrine/vendor/autoload.php';

require_once "$root/mvc/model/Model.php";

require_once "$root/mvc/model/Entrega.php";
require_once "$root/mvc/model/Item.php";
require_once "$root/mvc/model/Material.php";
require_once "$root/mvc/model/Medida.php";
require_once "$root/mvc/model/Pagamento.php";
require_once "$root/mvc/model/Pedido.php";
require_once "$root/mvc/model/Pessoa.php";
require_once "$root/mvc/model/Produto.php";
require_once "$root/mvc/model/Quimica.php";
require_once "$root/mvc/model/Tipo.php";
require_once "$root/mvc/model/Usuario.php";

require_once 'DBAL.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$paths = array("mvc/model/");
$isDevMode = true;
$connectionParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => getenv('IP'),
    'user'     => getenv('C9_USER'),
    'password' => '',
    'dbname'   => 'c9',
    'charset' => 'utf8'
);

$config = Setup::createConfiguration($isDevMode);
$driver = new AnnotationDriver(new AnnotationReader(), $paths);

// registering noop annotation autoloader - allow all annotations by default
AnnotationRegistry::registerLoader('class_exists');
$config->setMetadataDriverImpl($driver);

$orm = EntityManager::create($connectionParams, $config);