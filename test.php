<?php

foreach (['a','c','d'] as $v){
$arr = [1,2,3];
foreach ($arr as $val){
    if ($val == 2){
        $arr = [];
        break;
    }
    echo $val;
}

}