<?php
//获取德育分详情列表

define('IN_INDEX', true);

include 'db.php';

include 'lib.php';

$token = $_POST['token'];

if(isset($token)){
    if(checkToken($token, $conn)){
        $tokenData = json_decode(parseToken($token), true);
        $userid = $tokenData['username'];
        $sql = "SELECT * FROM lists WHERE userid = '$userid' ORDER BY id ASC";
        $result = $conn->query($sql);
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        //如果data不为空，则给每一条数据加上一个字段totalScore，计算每一条数组往上的总分
        if(!empty($data)){
            $defineScore = getServerConfig()['DeYuFen']['defineScore'];
            $totalScore = $defineScore;
            for ($i = 0; $i < count($data); $i++){
                $now = $data[$i];
                $score = $now['score'];
                $totalScore += $score;
                $data[$i]['totalScore'] = $totalScore;
            }
        }
        $arr = array(
            "code" => 200,
            "msg" => "获取德育分详情列表成功",
            "data" => $data
        );
    }else{
        $arr = array(
            "code" => 401,
            "msg" => "token非法或已过期",
            "data" => []
        );
    }
}else{
    $arr = array(
        "code" => 400,
        "msg" => "缺少参数",
        "data" => []
    );
}

mysqli_close($conn);
echo json_encode($arr);