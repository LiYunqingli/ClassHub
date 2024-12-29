<?php

//连接数据库，请注意修改为当前数据库的数据库信息

$username = "root";
$password = "Lihuarong5887";
$host = "localhost";
$dbname = "ClassHub";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}