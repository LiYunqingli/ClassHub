<?php
//引入公共函数库

include '../publicLib.php';


//插件专用的函数库

//禁止此脚本被直接访问，只允许通过include或require引入
if (!defined('IN_INDEX')) {
    exit('拒绝访问');
}
