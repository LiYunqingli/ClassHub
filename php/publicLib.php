<?php

//公共的函数库，用于存放一些常用的函数而并非是业务逻辑相关的函数


//获取服务器配置
function getServerConfig(){
    return json_decode(file_get_contents("./config.json"), true);
}