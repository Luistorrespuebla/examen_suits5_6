<?php

$servidor="localhost:3307";
$baseDeDatos="app";
$usuario="root";
$contrasenia="";

try{
    $conexion=new PDO("mysql:host=$servidor; dbname=$baseDeDatos",$usuario,$contrasenia);
}catch(Exception $ex){
    echo $ex->getMessage();
}
?>