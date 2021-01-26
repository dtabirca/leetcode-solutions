<?php

/**
 * PHP solutions for LeetCode challenges
 * @link https://leetcode.com/problemset/all/
 */


/**
 * #1 - Two Sum
 * @param array $l1 list1
 * @param array $l2 list2
 * @return array $l3 list3
 */
function addTwoNumbers($l1, $l2)
{
    $n1 = (int) implode('', array_reverse($l1));
    $n2 = (int) implode('', array_reverse($l2));
    $sum = $n1 + $n2;
    $l3 = array_reverse(array_map('intval', str_split($sum)));
    return $l3;
}

/**
 * #3 - Longest Substring Without Repeating Characters
 * @param  string $s input
 * @return integer $count length
 */
function lengthOfLongestSubstring($s)
{
    $count = 0;
    $substr = '';
    while (strlen($s) > 0) {
        $substr = '';
        for ($i = 0; $i < strlen($s); $i++) {
            if (strpos($substr, $s[$i]) === false) {
                $substr .= $s[$i];
            } else {
                break;
            }
        }
        if (strlen($substr) > $count) {
            $count = strlen($substr);
        }
        $s = substr($s, 1);
    }

    return $count;
}

/**
 * #4 - Median of Two Sorted Arrays
 * @param  array $nums1 array1
 * @param  array $nums2 array2
 * @return integer median
 */
function findMedianSortedArrays($nums1, $nums2)
{
    $nums3 = array_merge($nums1, $nums2);
    sort($nums3);
    $count = count($nums3);
    if ($count % 2 == 1) {
        // odd
        return $nums3[round($count / 2, 0, PHP_ROUND_HALF_DOWN)];
    } else {
        // even
        return ($nums3[$count / 2] + $nums3[$count / 2 - 1]) / 2;
    }
}

/**
 * #5 - Longest Palindromic Substring
 * @param  string $s input
 * @return string $solution palindrom
 */
function longestPalindrome($s)
{
    $solution = $s[0];
    for ($i = 0; $i < strlen($s); $i++) {
        for ($j = strlen($s) - 1; $j > $i; $j--) {
            if ($s[$j] == $s[$i]) {
                $fullchunk = $j - $i + 1;
                $halfchunk = round($fullchunk / 2, PHP_ROUND_HALF_DOWN);
                $chunk1 = substr($s, $i, $halfchunk);
                if ($fullchunk % 2 == 0) {
                    $chunk2 = substr($s, $i + $halfchunk, $halfchunk);
                } else {
                    $chunk2 = substr($s, $i + $halfchunk + 1, $halfchunk);
                }
                if ($chunk1 == strrev($chunk2)) {
                    if (strlen($solution) <= $fullchunk) {
                        $solution = substr($s, $i, $fullchunk);
                    }
                }
            }
        }
    }
    return $solution;
}

/**
 * #6 - ZigZag Conversion
 * @param  string $s input
 * @param  integer $numRows lines
 * @return string zigzag reading
 */
function convert($s, $numRows)
{
    $zigZag = [];
    for ($i = 0; $i < strlen($s); $i++) {
        // position in a zig-zag segment
        $position = fmod($i, $numRows * 2 - 2) + 1;
        if ($position > $numRows) {
            // reverse direction
            $row = $numRows - ($position - $numRows);
        } else {
            // normal direction
            $row = $position;
        }
        $zigZag[$row] = $zigZag[$row] ?? '';
        $zigZag[$row] .= $s[$i];
    }

    return implode('', $zigZag);
}

/**
 * #7 - Reverse Integer
 * @param  [type] $x [description]
 * @return [type]    [description]
 */
function reverse($x)
{
    $s = (string)$x;
    if ($s[0] == '-') {
        $r = '-' . strrev(substr($s, 1));
        $r = (int)$r;
    } else {
        $r = (int)strrev($s);
    }
    if (-2147483647 <= $r && $r <= 2147483647) {
        return $r;
    }
    return 0;
}

/**
 * #8 - String to Integer (atoi)
 * @param String $s
 * @return Integer
 */
function myAtoi($s)
{
    $i = '';
    $s = trim($s);
    if ($s[0] == '-' || $s[0] == '+') {
        $i = $s[0];
        $s = substr($s, 1);
    }
    for ($a = 0; $a < strlen($s); $a++) {
        if (is_numeric($s[$a])) {
            $i .= $s[$a];
        } else {
            break;
        }
    }
    $i = intval($i);
    if ($i < -2147483648) {
        return -2147483648;
    }
    if ($i > 2147483647) {
        return 2147483647;
    }
    return $i;
}

/**
 * #9 - Palindrome Number
 * @param Integer $x
 * @return Boolean
 */
function isPalindrome($x)
{
    $x = (string)$x;
    if ($x == strrev($x)) {
        return true;
    }
    return false;
}

/**
 * #10 - Regular Expression Matching
 * @param String $s
 * @param String $p
 * @return Boolean
 */
function isMatch($s, $p)
{
    return preg_match("/^" . $p . "$/", $s);
}

/**
 * #11 - Container With Most Water
 * @param Integer[] $height
 * @return Integer
 */
function maxArea($height) {
    $max = 0;
    $x = 0;
    $i = count($height)-1;
    while($x < $i) {
        $area = min($height[$x], $height[$i]) * ($i - $x);    
        if ($area > $max){
            $max = $area;
        }
        if ($height[$x] <= $height[$i]) {
            $x++;
        } else {
            $i--;
        }
    }
    return $max;
}
// Brute force solution exceeds time limit
// function maxArea($height) {
//     $max = 0;
//     for ($x = 0; $x < count($height); $x++) {
//         for ($i = count($height) - 1; $i > $x; $i--) {
//             $area = min($height[$x], $height[$i]) * ($i - $x);
//             if ($area > $max){
//                 $max = $area;
//             }
//         }
//     }
//     return $max;
// }