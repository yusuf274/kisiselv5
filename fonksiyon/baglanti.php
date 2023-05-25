<?php

try {
    $baglanti=new PDO("mysql:host=localhost;dbname=demokisiselv5;charset=utf8","root","");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die($e->getMessage());
}


?>