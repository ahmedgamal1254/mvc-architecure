<?php 

class App{
    protected $controller="HomeController";
    protected $method="index";
    protected $params=[];

    public function __construct($request=[]){
        if($request["method"] !== $_SERVER["REQUEST_METHOD"]){
            throw new Exception("Method " . $request["method"] . " no support for this route");
        }

        if(!empty(trim($_SERVER["REQUEST_URI"],"/"))){
            $this->prepareUrl($request["callbacks"][0],$request["callbacks"][1]);

            $this->params=$request["params"];

            $this->render();
        }else{
            $this->prepareUrl("HomeController","index");

            $this->render();
        }
    }

    private function prepareUrl($controller,$method){
        
        $this->controller=isset($controller) ? $controller:"HomeController";

        $this->method=isset($method) ? $method:'index';

    }


    public function render(){
        if(class_exists($this->controller)){
            $controller=new $this->controller;

            if(method_exists($controller,$this->method)){
                call_user_func_array([$controller,$this->method],$this->params);

            }else{
                echo "method " . $this->method . " not found";
            }
        }else{
            echo "controller " . $this->controller . " not found exists";
        }
    }
}
?>