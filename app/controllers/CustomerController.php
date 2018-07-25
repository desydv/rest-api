<?php

namespace App\Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Models\Customer;

final class CustomerController{

    public function getCustomers(Request $request, Response $response, $args)
    {
        $customers = Customer::all();
        return $response->withJson(["status" => "success", "data" => $customers], 200);
    }

    public function getSpecificCustomer(Request $request, Response $response, $args){
        $customer = Customer::find($args['id']);
        return $response->withJson(["status" => "success", "data" => $customer], 200);
    }

    public function createCustomer(Request $request, Response $response, $args){
        $input = $request->getParsedBody();
        $customer = Customer::create($input);
          if($customer){
            return $response->withJson(["status" => "success", "data" => $customer], 200);
          }else{
            return $response->withJson(["status" => "failed", "data" => $customer], 200);
          }
    }

    public function updateCustomer(Request $request, Response $response, $args){
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
    }

    public function deleteCustomer(Request $request, Response $response, $args){
        $customer = Customer::destroy($args['id']);
        if($customer){
          return $response->withJson(["status" => "success", "data" => $customer], 200);
        }else{
          return $response->withJson(["status" => "failed", "data" => $customer], 200);
        }
    }
    
    public function changePassword(Request $request, Response $response, $args){
        $input = $request->getParsedBody();

        $customer = Customer::find($args['id']);
        if($customer->password != $input['old-password']){
            return $response->withJson(["status" => "failed"], 403);
        }
        $customer->password = $input['new-password'];
        $customer->save();
       
        if($customer){
            return $response->withJson(["status" => "success"], 200);
        }else{
            return $response->withJson(["status" => "failed"], 200);
        }
    }

}