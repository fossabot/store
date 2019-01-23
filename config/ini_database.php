<?php
namespace capudev\config;
use Illuminate\Database\Capsule\Manager as Database;

$database = new Database;
$database->addConnection([
'driver' => getenv("DB_DRIVER"),
'host' => getenv("DB_HOST"),
'database' => getenv("DB_DATABASE"),
'username' => getenv("DB_USERNAME"),
'password' => getenv("DB_PASSWORD"),
'charset'  => getenv("DB_CHARSET"),
'collation'=> getenv("DB_COLLATION"),
]);
$database->setAsGlobal();
$database->bootEloquent();


/* 
Ejemplos

//Consultar todos los registros
$usuarios = $database::table('users')->get();

//Consultar por WHERE =1
$usuarios = $database::table('users')->where('id','=',1) ->get();

//buscar registro por ID



//Ingsetar registro


//borrar registro


*/

