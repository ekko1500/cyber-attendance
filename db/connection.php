<?php
try{
$pdo=new PDO("mysql:host=localhost;dbname=cyber",'root','root');
// echo "OK";
}
catch(PDOExeption $e){
    echo $e->getMessage();
}
?>