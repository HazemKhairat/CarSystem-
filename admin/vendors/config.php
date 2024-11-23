<?php


try{
    $conn = mysqli_connect('localhost', 'root', '', 'cars');
}catch(Exception $e){
    echo $e->getMessage();
}