<?php
define('IN_INDEX', true);//允许请求库lib.php
include "lib.php";

$username = $_POST['username'];
$password = $_POST['password'];



if(!checkParm($username) || !checkParm($password)){
    $arr = array(
        "code" => 200,
        "msg" => "success",
        "data" => []
    );
}else{
    $arr = array(
        "code" => 100,
        "msg" => "error",
        "data" => []
    );
}

echo json_encode($arr);