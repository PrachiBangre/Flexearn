<?php

$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power';
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../db_config.php");
if (isset($_POST['permission'])) {
    $permission = $_POST['permission'];
    $permissionValue = $_POST['permissionValue'];
    $userId = $_POST['userId'];
    echo "UPDATE `user_role` SET $permission = '$permissionValue' WHERE `user_role`.`id` = $userId";
    $updateResult = $conn->query("UPDATE `user_role` SET $permission = '$permissionValue' WHERE `user_role`.`adminID` = $userId");
    echo $updateResult;
}
