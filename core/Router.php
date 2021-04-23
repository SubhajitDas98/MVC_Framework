<?php
    namespace Core;
    class Router
    {
        private $routes;
        public function routeHandler($url,$routes)
        {
            $this->routes=$routes;
            
            $method=strtolower($_SERVER["REQUEST_METHOD"]);
            $value=$this->parseUrl($url);
            //var_dump($value);
            if (key_exists($value,$this->routes[$method]))
            {
                $destination_string=$this->routes[$method][$value];
                $destination_array=explode("@",$destination_string);
                $class="Core\\".$destination_array[0];
                $obj = new $class();
                $obj->{$destination_array[1]}();
            }
            else
            {
                echo "error 404. Page not found";
            }
        }
        public function parseUrl($url)
        {
            if(strpos($url,"?"))
            {   
                $newurl=explode("?",$url);
                
                $endpoint=$newurl[0];
                return $endpoint;
            }
            else
            {
                return $url;
            }
        }
    }

?>