<?php
/**
 * 算法：选择排序
 */

$arr     = [10, 19, 55, 34, 41, 2, 10];
$sortArr = selectSort($arr); //排序好的数组
var_dump($sortArr);

//从小到大排序,平均时间复杂度O(n2)
function selectSort($arr)
{
    $sortArr = [];
    $len     = count($arr);
    for ($i = 0; $i < $len; $i++) {
        $min = $arr[$i];
        for ($j = $i + 1; $j < $len; $j++) {
            if ($min > $arr[$j]) {
                $temp    = $arr[$j];
                $arr[$j] = $min;
                $min     = $temp;

            }
        }
        $sortArr[] = $min;
    }
    return $sortArr;
}
