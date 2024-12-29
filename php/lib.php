<?php

//此脚本用于存放一些常用的函数，请注意注释，后期写文档好整理


//禁止此脚本被直接访问，只允许通过include或require引入
if (!defined('IN_INDEX')) {
    exit('拒绝访问');
}

//检查传入的参数是否为空或者有效
function checkParm($str)
{
    if (!isset($str) || empty($str)) {
        return false;
    } else {
        return true;
    }
}

//普通用户登录，传入用户名密码和数据库连接，返回true或false
//type["admin","user"]
function login($userid, $password, $conn, $type)
{
    //type参数是写死的，因为平台只有两种登录类型，包括插件市场在内的所有应用
    if ($type == "admin") {
        $sql = "SELECT * FROM admins WHERE adminid = '$userid' AND password = '$password'";
    } else {
        $sql = "SELECT * FROM users WHERE userid = '$userid' AND password = '$password'";
    }

    $result = $conn->query($sql);
    if ($result->error) {
        return false;//这里可能需要优化并且记录日志
    }
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

//生成token
function getToken($userid, $password, $type)
{
    //读取json文件config.json
    $config = json_decode(file_get_contents("./config.json"), true);
    $key = $config["TokenPublicKey"];
}