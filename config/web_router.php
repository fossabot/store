<?php
use Aura\Router\RouterContainer;

//load const .env
$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

echo getenv("DB_HOST");
die();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
$_SERVER,
$_GET,
$_POST,
$_COOKIE,
$_FILES
);
$routerContainer = new RouterContainer();
$namespace = "capudev";
$controllerApp = "Controller";

//Generating web Maping
$map = $routerContainer->getMap();

$map->get('index', '/', [
'controller' => $namespace.'\Controllers\Index'.$controllerApp,
'action' => 'indexAction'
]);
$map->get('loginForm', '/login', [
    'controller' => 'capudev\Controllers\UsersController',
    'action' => 'getLogin'
]);
$map->get('logout', '/logout', [
    'controller' => 'capudev\Controllers\UsersController',
    'action' => 'getLogout'
]);
$map->post('auth', '/auth', [
    'controller' => 'capudev\Controllers\UsersController',
    'action' => 'postLogin'
]);
$map->get('admin', '/admin', [
    'controller' => 'capudev\Controllers\AdminController',
    'action' => 'getIndex',
    'auth' => true
]);




$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if (!$route) {
die("Esta pagina no exite");
}else{
 $handlerData = $route->handler;
 $controllerName = $handlerData['controller'];
 $actionName = $handlerData['action'];
 $needsAuth = $handlerData['auth'] ?? false;

 $sessionUserId = $_SESSION['userId'] ?? null;
 if ($needsAuth && !$sessionUserId) {
 echo 'Protected route';
 die;
 }

 $controller = new $controllerName;
 $response = $controller->$actionName($request);


 foreach($response->getHeaders() as $name => $values)
 {
 foreach($values as $value) {
 header(sprintf('%s: %s', $name, $value), false);
 }
 }
 http_response_code($response->getStatusCode());
 echo $response->getBody();
 
}

