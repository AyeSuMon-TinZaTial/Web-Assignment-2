<?php 
$db = mysqli_connect('localhost', 'root', '', 'php_crud');
if(!$db){
    die("Connection failed: " . mysqli_connect_error());
}
?>