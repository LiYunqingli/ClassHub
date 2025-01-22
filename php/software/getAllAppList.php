<?php
//获取所有软件列表

include 'db.php';

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
$conn->close();

echo json_encode($arr);