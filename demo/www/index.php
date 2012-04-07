<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

define('APPLICATION_ROOT', realpath('../'));

include '../../external/slim/Slim/Slim.php';

include '../../../lean/lean/init.php';
$autoload = new \lean\Autoload();
$autoload->register('demo', APPLICATION_ROOT . '/lib');

$application = new \lean\Application(array('debug' => true));

$application->registerRoute('css', '/css/:action(/:file)', array('controller' => '\\demo\\controller\\CSS'));

$application->registerControllerDefaultRoute('\\demo\\controller');
$application->run();
?>