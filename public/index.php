<?php
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';

// load our environment files - used to store credentials & configuration
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env' );
$dotenv->load();

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER_NAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


$containerBuilder = new ContainerBuilder();
AppFactory::setContainer($containerBuilder->build());

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

require __DIR__ . '/../routes/api.php';

$app->run();
