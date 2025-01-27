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

//检查token是否有效，传入token返回解析后的内容
function checkLoginToken($token, $conn, $type)
{
    if (($data = parseToken($token)) != null) {
        $data = json_decode($data, true);
        if (login($data['username'], $data['password'], $conn, $type)) {
        }
    }
}

//检查token是否合法
function checkToken($token, $conn){
    $user_token_data = json_decode(parseToken($token), true);
    $userid = $user_token_data['username'];
    $password = $user_token_data['password'];
    $time = $user_token_data['time'];

    $config = getServerConfig();
    $TokenExpireTime = $config["TokenExpireTime"];//单位是day
    // if (time() - $time > 3600) {
    if (time() - $time > $TokenExpireTime * 24 * 3600) { //token过期时间
        return false;
    }else{
        $sql = "SELECT * FROM admins WHERE adminid = '$userid' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}

//创建token，传入用户名以及密码，返回token
function createToken($username, $password)
{
    $config = getServerConfig();
    $key = $config["TokenPublicKey"];
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $time = strtotime('+1 day');
    $data = $username . '[$$$]' . $password . '[$$$]' . $time;
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

//解析token，传入token，返回用户名以及密码和时间
function parseToken($token)
{
    $config = getServerConfig();
    $key = $config["TokenPublicKey"];
    $data = base64_decode($token);
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);

    if ($decrypted === false) {
        return null; // 解密失败
        //后期需要写入日志文件
    }

    list($username, $password, $time) = explode('[$$$]', $decrypted);

    // 返回解析结果
    $data = array(
        'username' => $username,
        'password' => $password,
        'time' => $time
    );
    return json_encode($data);
}

function getServerConfig(){
    return json_decode(file_get_contents("../../php/config.json"), true);
}