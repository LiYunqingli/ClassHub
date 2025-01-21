<?php
include '../db.php';
//获取软件详情

$id = $_POST['id'];

if (isset($id)) {

    $sql = "SELECT * FROM softwares WHERE id = '$id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $arr = array(
            "code" => 200,
            "msg" => "获取软件信息成功",
            "data" => $row
        );
    } else {
        $arr = array(
            "code" => 402,
            "msg" => "获取软件信息失败，可能是发送的数据无效",
            "data" => []
        );
    }
}else{
    $arr = array(
        "code" => 400,
        "msg" => "参数不全",
        "data" => []
    );
}
$conn->close();

echo json_encode($arr);