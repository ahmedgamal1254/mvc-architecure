<?php 

class Route{
    public $routes=[];

    public $reqest=[];


    public function __construct(){
        $this->reqest=["method" => $_SERVER["REQUEST_METHOD"],"url" => $_SERVER["REQUEST_URI"]];
    }

    public function get($url,$callbacks=[]){
        $method='GET';
        
        $this->routes[]=compact('method','url','callbacks');
    }

    public function post($url,$callbacks=[]){
        $method='POST';

        $this->routes[]=compact('method','url','callbacks');
    }

    public function dispatch(){
        $route=$this->check_route($this->reqest);

        if(!$route){
            throw new Exception("Route not found");
        }

        return $route;
    }

    private function check_route($request){
        $extract_correct_route=[];

        foreach ($this->routes as $route) {
            $split_route=explode("/",trim($route["url"],"/"));

            $split_url=explode("/",trim($request["url"],"/"));
            
            if(preg_match('#^' . $split_route[0] . '$#', $split_url[0],$matches)){
                array_shift($matches);

                $extract_correct_route[]=$route;
            }

        }

        if(empty($extract_correct_route)){
            return null;
        }else{
            for ($i=0; $i < count($extract_correct_route); $i++) { 
                $url=$this->url_specifiec($extract_correct_route[$i]["url"],$request["url"])[0];
                $route=$this->url_specifiec($extract_correct_route[$i]["url"],$request["url"])[1];

                if($url==$route){
                    $routes=$extract_correct_route[$i];
                    $routes["params"]=$this->get_params($extract_correct_route[$i]["url"],$request["url"]);
                    
                    if(!$routes){
                        throw new Exception("Route Not Found");
                    }

                    return $routes;
                }
            }
        }

    }

    private function url_specifiec($url,$route) {
        $split_route=explode("/",trim($url,"/"));

        $split_url=explode("/",trim($route,"/"));

        $pattern = '/\{[^}]+\}/';

        if(count($split_route) == count($split_url)){
            $url='';
            $route='';

            for ($i=0; $i < count($split_route); $i++) { 
                if(!preg_match_all($pattern, $split_route[$i], $matches1)){
                    $url.=$split_route[$i] .  "/";
                    $route.=$split_url[$i] . "/";
                }
            }

            return [$url,$route];
        }else{
            throw new Exception("Route " . $route . " not found in your system");   
        }

    }

    private function get_params($url,$route){
        $split_route=explode("/",trim($url,"/"));

        $split_url=explode("/",trim($route,"/"));

        $pattern = '/\{[^}]+\}/';

        $params=[];

        if(count($split_route) == count($split_url)){

            for ($i=0; $i < count($split_route); $i++) { 
                if(preg_match_all($pattern, $split_route[$i], $matches1)){
                    $params[substr($split_route[$i],1,strlen($split_route[$i])-2)]=$split_url[$i];       
                }
            }

            return $params;
        }
    }
}

$routes=new Route();