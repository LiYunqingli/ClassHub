<?php

define('IN_INDEX', true);

include 'db.php';
include 'lib.php';

$token = $_GET['token'];

if (isset($token)){
    if(checkToken($token, $conn)){
        $arr = array(
            "code" => 200,
            "msg" => "token验证成功"
        );
    }else{
        $arr = array(
            "code" => 401,
            "msg" => "token验证失败，无效的令牌"
        );
    }
}else{
    $arr = array(
        "code" => 400,
        "msg" => "参数不全，请检查，本接口使用GET请求，请检查方式是否错误"
    );
}

echo json_encode($arr);