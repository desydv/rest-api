<?php

namespace app\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

final class ApiController{
    public function hello(Request $request, Response $response, $args)
    {
        $dataRes =[
            'apiVersion' => getenv('APP_VERSION'),
            'data' => [
                'serverTime' => date("Y-m-d H:i:s"), 
            ]
        ];
        return $response->withJSON($dataRes,200,JSON_UNESCAPED_UNICODE);
    }
    
}