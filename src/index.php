<?php

declare(strict_types=1);

use App\Helpers\Router;
use Dotenv\Dotenv;
use MongoDB\Client;

require 'vendor/autoload.php'; // Include Composer's autoloader
require 'helpers.php';         // Include the helpers file

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Define environment constants
define('APP_ENV', $_ENV['APP_ENV'] ?? 'production');
define('DEBUG', filter_var($_ENV['DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN));
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_PORT', $_ENV['DB_PORT'] ?? '27017');
define('DB_DATABASE', $_ENV['DB_DATABASE'] ?? 'example');
define('DB_USERNAME', $_ENV['DB_USERNAME'] ?? 'root');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? 'password');

// Error display based on environment
if (APP_ENV === 'local') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

set_error_handler(function ($severity, $message, $file, $line): void {
    if (!(error_reporting() & $severity)) {
        // Ignore errors not included in error_reporting
        return;
    }

    ddd([
        'type' => 'Error',
        'severity' => $severity,
        'message' => $message,
        'file' => $file,
        'line' => $line,
    ]);
});

set_exception_handler(function ($exception) {
    ddd([
        'type' => 'Exception',
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString(),
    ]);
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null) {
        ddd([
            'type' => 'Fatal Error',
            'message' => $error['message'],
            'file' => $error['file'],
            'line' => $error['line'],
        ]);
    }
});

// Initialize MongoDB client
$connection_string = sprintf(
    "mongodb://%s:%s@%s:%s/%s?authSource=admin",
    DB_USERNAME,
    DB_PASSWORD,
    DB_HOST,
    DB_PORT,
    DB_DATABASE
);
$mongo_client = new Client($connection_string);

$router = new Router($mongo_client);

$router->addRoute('', 'HomeController', 'index');

$router->addRoute('pokemon/list', 'PokemonController', 'list');

$router->addRoute('pokemon/{id}', 'PokemonController', 'details');

$router->addRoute('pokemon/index', 'PokemonController', 'index');

$router->addRoute('pokemon/edit/{id}', 'PokemonController', 'edit');

$router->addRoute('/pokemon/filter', 'PokemonController', 'filter');



echo $router->handle($_SERVER['REQUEST_URI']);
