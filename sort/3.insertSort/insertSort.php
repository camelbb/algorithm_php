<?php
/**
 * 算法：插入排序
 */

$arr     = [10, 19, 55, 34, 41, 2, 10];
$sortArr = insertSort($arr); //排序好的数组
var_dump($sortArr);

//从小到大排序,平均时间复杂度O(n2)
function insertSort($arr)
{
    $sortArr = [];
    for ($i = 1; $i < count($arr); $i++) {
        if ($i == 0) {
            $sortArr[] = $arr[0];
            continue;
        }
        $preIndex = count($sortArr) - 1;
        //当要插入的值小于排序好的前一个值时，排序好的数组就往后移动一位，最后找到插入的位置
        while ($preIndex >= 0 && $sortArr[$preIndex] > $arr[$i]) {
            $sortArr[$preIndex + 1] = $sortArr[$preIndex];
            $preIndex--;
        }
        $sortArr[$preIndex + 1] = $arr[$i];
    }
    return $sortArr;
}
