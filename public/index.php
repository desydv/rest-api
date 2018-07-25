<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use app\models\Customer;
use app\controllers\CustomerController;
use app\controllers\ApiController;
require '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../src/dependencies.php';

$app->get('/', ApiController::class.':hello');

$app->get('/customers', CustomerController::class.':getCustomers');

$app->get('/customer/[{id}]', CustomerController::class.':getSpecificCustomer');

$app->post('/customer', CustomerController::class.':createCustomer');

$app->put('/customer/[{id}]', CustomerController::class.':updateCustomer');

$app->delete('/customer/[{id}]', CustomerController::class.':deleteCustomer');

$app->put('/change-password/[{id}]', CustomerController::class.':changePassword');

$app->run();