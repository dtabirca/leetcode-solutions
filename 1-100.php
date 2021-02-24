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
function maxArea($height)
{
    $max = 0;
    $x = 0;
    $i = count($height) - 1;
    while ($x < $i) {
        $area = min($height[$x], $height[$i]) * ($i - $x);
        if ($area > $max) {
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

/**
 * #12 - Integer to Roman
 * @param Integer $num
 * @return String
 */
function intToRoman($num)
{
    $roman = '';
    if ($num / 1000 >= 1) {
        $roman .= str_repeat('M', floor($num / 1000));
        $num = $num % 1000;
    }
    if ($num >= 100) {
        $hundreds = floor($num / 100);
        if ($hundreds <= 3) {
            $roman .= str_repeat('C', $hundreds);
        } else if ($hundreds == 4) {
            $roman .= 'CD';
        } else if ($hundreds >= 5 && $hundreds <= 8) {
            $roman .= 'D' . str_repeat('C', $hundreds - 5);
        } else {
            $roman .= 'CM';
        }
        $num = $num % 100;
    }
    if ($num >= 10) {
        $dozens = floor($num / 10);
        if ($dozens <= 3) {
            $roman .= str_repeat('X', $dozens);
        } else if ($dozens == 4) {
            $roman .= 'XL';
        } else if ($dozens >= 5 && $dozens <= 8) {
            $roman .= 'L' . str_repeat('X', $dozens - 5);
        } else {
            $roman .= 'XC';
        }
        $num = $num % 10;
    }
    if ($num > 0) {
        if ($num <= 3) {
            $roman .= str_repeat('I', $num);
        } else if ($num == 4) {
            $roman .= 'IV';
        } else if ($num >= 5 && $num <= 8) {
            $roman .= 'V' . str_repeat('I', $num - 5);
        } else {
            $roman .= 'IX';
        }
    }
    return $roman;
}

/**
 * #13 - Roman to Integer
 * @param String $s
 * @return Integer
 */
function romanToInt($s)
{
    $int = 0;
    while (strlen($s) > 0) {
        $letter = $s[0];
        $s = substr($s, 1);
        switch ($letter) {
            case 'M':
                $int += 1000;
                break;
            case 'D':
                $int += 500;
                break;
            case 'C':
                if ($s[0] == 'D') {
                    $int += 400;
                    $s = substr($s, 1);
                } else if ($s[0] == 'M') {
                    $int += 900;
                    $s = substr($s, 1);
                } else {
                    $int += 100;
                }
                break;
            case 'L':
                $int += 50;
                break;
            case 'X':
                if (isset($s[0]) && $s[0] == 'L') {
                    $int += 40;
                    $s = substr($s, 1);
                } else if (isset($s[0]) && $s[0] == 'C') {
                    $int += 90;
                    $s = substr($s, 1);
                } else {
                    $int += 10;
                }
                break;
            case 'V':
                $int += 5;
                break;
            case 'I':
                if (isset($s[0]) && $s[0] == 'V') {
                    $int += 4;
                    $s = substr($s, 1);
                } else if (isset($s[0]) && $s[0] == 'X') {
                    $int += 9;
                    $s = substr($s, 1);
                } else {
                    $int += 1;
                }
                break;
        }
    }
    return $int;
}

/**
 * 14 - Longest Common Prefix
 * @param String[] $strs
 * @return String
 */
function longestCommonPrefix($strs)
{
    $shortest = min(array_map('strlen', $strs));
    while ($shortest > 0) {
        $found = true;
        if ($prefix = substr($strs[0], 0, $shortest)) {
            foreach ($strs as $s) {
                if (substr($s, 0, $shortest) !== $prefix) {
                    $found = false;
                    $shortest--;
                    break;
                }
            }
            if ($found) {
                return $prefix;
            }
        }
    }
    return "";
}

/**
 * #15 - 3Sum
 *
 * Brute force solution exceeds time limit
 *  
 * @param Integer[] $nums
 * @return Integer[][]
 */
function threeSum($nums)
{
    $matches = [];
    for ($i = count($nums)-1; $i >= 0; $i--) {
        for ($j = $i-1; $j >= 0; $j--) {
            $need = -($nums[$i] + $nums[$j]);
            $three = array_keys($nums, $need);
            foreach ($three as $k) {
                if ($j != $k && $i != $k) {
                    $match = [$nums[$i], $nums[$j], $need];
                    sort($match);
                    if (!in_array($match, $matches)) {
                        $matches[] = $match;
                    }
                }
            }
        }
    }
    return $matches;
}

/**
 * #17 - Letter Combinations of a Phone Number
 * 
 * @param String $digits
 * @return String[]
 */
function letterCombinations($digits)
{
        
        $letters = [
            2 => ['a', 'b', 'c'],
            3 => ['d', 'e', 'f'],
            4 => ['g', 'h', 'i'],
            5 => ['j', 'k', 'l'],
            6 => ['m', 'n', 'o'],
            7 => ['p', 'q', 'r', 's'],
            8 => ['t', 'u', 'v'],
            9 => ['w', 'x', 'y', 'z'],
        ];

        $digits = str_split($digits);
        $combinations = [];
        foreach ($digits as $k => $x) {
            $inter = [];
            foreach ($letters[(int)$x] as $y) {
                if ($k === 0) {
                    $inter[] = $y;
                } else {
                    foreach ($combinations as $c){
                        $inter[] = $c . $y;
                    }
                }
            }
            $combinations = $inter;
        }
        return $combinations;
}

/**
 * #19 - Remove Nth Node From End of List
 * 
 * @param ListNode $head
 * @param Integer $n
 * @return ListNode
 */


/**
 * 20. Valid Parentheses
 * 
 * @param String $s
 * @return Boolean
 */
function isValid($s)
{
    while (strlen($s) > 0) {
        $s2 = str_replace(array('{}','[]','()'), '', $s);
        if ($s2 == $s) {
            return false;
        }
        $s = $s2;
    }
    return true;
}