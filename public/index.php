<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use DI\Container;

define( 'BASEROOT', __DIR__ .'/../');
require BASEROOT . 'vendor/autoload.php';

// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Set view in Container
$container->set('view', function() {
    return Twig::create( BASEROOT . 'templates/');
});

//use config.
$container->set('db', function(){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "test";

	$mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
	$dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass);
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
});

$app = AppFactory::create();
$app->setBasePath("/sample/public/index.php");
//$app->addErrorMiddleware(false, true, true);

// Add Twig-View Middleware
$app->add(TwigMiddleware::createFromContainer($app));

// route
require BASEROOT . 'src/Route/Route.php';


$app->run();