<?php
use DI\ContainerBuilder;

require_once __DIR__.'/../../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../../src/settings.php';
$app = new class() extends \DI\Bridge\Slim\App {
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions(__DIR__ . '/../../src/settings.php');
    }
};
// Set up dependencies
require __DIR__ . '/../../src/dependencies.php';
// Register middleware
require __DIR__ . '/../../src/middleware.php';
// Register routes
require __DIR__ . '/../../src/routes.php';
// Run app
return $app;

?>