<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Nette\Mail\Message;
use App\Models\Customer;
require '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../src/dependencies.php';

$app->get('/', function ($request, $response, $args) {
    $this->logger->info("/");
    $dataRes =[
            'apiVersion' => getenv('APP_VERSION'),
            'data' => [
                'serverTime' => date("Y-m-d H:i:s"), 
            ]
        ];
   return $response->withJSON($dataRes,200,JSON_UNESCAPED_UNICODE);
});

$app->get('/customers', function ($request, $response, $args) {
    $customers = Customer::all();
    return $this->response->withJson(["status" => "success", "data" => $customers], 200);
});

$app->get('/customer/[{id}]', function ($request, $response, $args) {
    $customer = Customer::find($args['id']);
    return $this->response->withJson(["status" => "success", "data" => $customer], 200);
});

$app->post('/customer', function ($request, $response) {
    $input = $request->getParsedBody();
    $customer = Customer::create($input);
    if($customer){
        return $response->withJson(["status" => "success", "data" => $customer], 200);
    }else{
        return $response->withJson(["status" => "failed", "data" => $customer], 200);
    }
});

$app->delete('/customer/[{id}]', function ($request, $response, $args) {     
    $customer = Customer::destroy($args['id']);
    if($customer){
        return $response->withJson(["status" => "success", "data" => $customer], 200);
    }else{
        return $response->withJson(["status" => "failed", "data" => $customer], 200);
    }
});

$app->put('/customer/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();

    $customer = Customer::find($args['id']);
    $customer->email = $input['email'];
    $customer->name = $input['name'];
    $customer->password = $input['password'];
    $customer->phone = $input['phone'];
    $customer->save();
   
    if($customer){
        return $response->withJson(["status" => "success", "data" => $customer], 200);
    }else{
        return $response->withJson(["status" => "failed", "data" => $customer], 200);
    }
});
$app->run();