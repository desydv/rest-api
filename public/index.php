<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Models\Customer;
use App\Controllers\CustomerController;
use App\Controllers\ApiController;
require '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../src/dependencies.php';

$app->get('/', 'ApiController:hello');

$app->get('/customers', 'CustomerController:getCustomers');

$app->get('/customer/[{id}]', 'CustomerController:getSpecificCustomer');

$app->post('/customer', 'CustomerController:createCustomer');

$app->put('/customer/[{id}]', 'CustomerController:updateCustomer');

$app->delete('/customer/[{id}]', 'CustomerController:deleteCustomer');

$app->put('/change-password/[{id}]', 'CustomerController:changePassword');

$app->run();