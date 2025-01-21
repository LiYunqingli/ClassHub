<?php

include 'lib.php';//引入函数库

$classID = "22109";

$data = getData($classID);//读取数据

$data = $data['data'];

$arr = array(
    "code" => 200,
    "msg"   => "success",
    "data"  => $data
);

echo json_encode($arr);