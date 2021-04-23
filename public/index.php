<?php 
    session_start();
    use Core\Router;
    require_once '../autoload.php';
    require_once '../routes/routes.php';
    $app= new Router();
    $url=$_SERVER["REQUEST_URI"];
    $app->routeHandler($url,$routes);
    
?>