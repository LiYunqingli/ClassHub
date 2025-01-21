<?php

//函数库

function getData($classID){
    return json_decode(file_get_contents("../data/$classID/data.json"), true);
}