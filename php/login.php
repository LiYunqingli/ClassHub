<?php
define('IN_INDEX', true);//允许请求库lib.php
include "lib.php";
include "db.php";

$username = $_POST['userid'];
$password = $_POST['password'];
$type = $_POST['type'];



if(checkParm($username) || checkParm($password) || checkParm($type)){
    if(login($username, $password, $conn, $type)){
        
        $arr = array(
            "code" => 200,
            "msg" => "登录成功",
            "token" => ""
        );
    }else{
        $arr = array(
            "code" => 401,
            "msg" => "登录失败，请检查用户名或密码",
            "token" => ""
        );
    }
}else{
    $arr = array(
        "code" => 400,
        "msg" => "error",
        "token" => ""
    );
}

echo json_encode($arr);