<?php
//获取所有软件列表

define('IN_INDEX', true);
define('ROOT_PATH', '../');
include 'db.php';
include '../lib.php';

$token = $_POST['token'];
$type = $_POST['type'];
if (isset($token) || isset($type)) {

    //暂时不验证token是否有效，或者是否管理员身份
    // if (checkToken($token, $conn)) {
    //     $tokenData = json_decode(parseToken($token), true);
    //     $userid = $tokenData['username'];
    // }


    $sql = "SELECT * FROM softwares";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $arr = array(
            "code" => 200,
            "msg" => "success",
            "data" => $data
        );
    } else {
        $arr = array(
            "code" => 201,
            "msg" => "no data",
            "data" => []
        );
    }
} else {
    $arr = array(
        "code" => 400,
        "msg" => "参数错误或者参数不全",
        "data" => []
    );
}

$conn->close();

echo json_encode($arr);