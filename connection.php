<?php
session_start();
date_default_timezone_set('Asia/Yangon');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$connection = mysqli_connect('localhost','root','','pizzamarui');
?>