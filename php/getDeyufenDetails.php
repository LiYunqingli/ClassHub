<?php
//获取德育分详情列表

define('IN_INDEX', true);

include 'db.php';
include 'lib.php';

$token = $_POST['token'];

if(isset($token)){
    if(checkToken($token, $conn)){
        $tokenData = json_decode(parseToken($token), true);
        $userid = $tokenData['username'];
        $arr = array(
            "code" => 200,
            "msg" => "获取德育分详情列表成功",
            "data" => $tokenData
        );
    }else{
        $arr = array(
            "code" => 401,
            "msg" => "token非法或已过期",
            "data" => []
        );
    }
}else{
    $arr = array(
        "code" => 400,
        "msg" => "缺少参数",
        "data" => []
    );
}

mysqli_close($conn);
echo json_encode($arr);