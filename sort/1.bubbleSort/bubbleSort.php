<?php

$arr     = [10, 19, 55, 34, 41, 2, 10];
$sortArr = bubbleSort($arr); //排序好的数组
var_dump($sortArr);

//从小到大排序,平均时间复杂度O(n2)
function bubbleSort($arr)
{
    $len = count($arr);
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = 0; $j < $len - $i - 1; $j++) { //每次排序都可以确定倒数第i个的位置
            if ($arr[$j] > $arr[$j + 1]) {
                $temp        = $arr[$j];
                $arr[$j]     = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }

    return $arr;
}
