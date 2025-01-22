<?php

//函数库

function getData($classID)
{
    return json_decode(file_get_contents("../data/$classID/data.json"), true);
}

function insertData($classID, $data, $path)
{
    $path = explode(".", $path);
    $database = getData($classID);
    $currentArray = &$database;
    foreach ($path as $key) {
        if (is_array($currentArray) && isset($currentArray[$key])) {
            $currentArray = &$currentArray[$key];
        } else {
            return;
        }
    }

    $currentArray[] = $data;

    // 将更新后的数据库内容写入文件
    file_put_contents("../data/$classID/data.json", json_encode($database, JSON_UNESCAPED_UNICODE));

}
