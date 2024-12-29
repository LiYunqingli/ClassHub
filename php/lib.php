<?php

//此脚本用于存放一些常用的函数，请注意注释，后期写文档好整理


//禁止此脚本被直接访问，只允许通过include或require引入
if (!defined('IN_INDEX')) {
    exit('拒绝访问');
}

//检查传入的参数是否为空或者有效
function checkParm($str){
    if(!isset($str) || empty($str)){
        return false;
    }else{
        return true;
    }
}