<?php

include 'lib.php';

$data = $_POST['data'];

$classID = "22109";
$path = "data";

insertData($classID,$data,$path);

$arr = array(
    "code" => 200,
    "msg"   => "success"

);
echo json_encode($arr);