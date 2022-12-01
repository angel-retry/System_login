<?php
$servername = "localhost";
$dbUsername = "id19931378_enju";
$dbPassword = "}HUh*6>QpmPEEO!*";
$dbName = "id19931378_loginsystem";

$connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$connection) {
    die("連接數據庫成失敗: ".mysqli_connect_errno());
    
}
?>