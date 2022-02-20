<?php

function getInput($filename) {
    $file = fopen($filename, 'r');
    if ($file) {
        $data = fread($file, filesize($filename));
        fclose($file);
    }

    return $data;
}

function evaluateStrings($input) {
    $nice_strings = 0;
    $strings = explode("\r\n", $input);

    while ($strings) {
        $str = array_shift($strings);
        if (isNice($str)) {
            $nice_strings++;
        }
    }

    return $nice_strings;
}

function isNice($str) {
    return (threeVowels($str) && doubleLetter($str) && noBadStrings($str)) ? true : false;
}

function threeVowels($str) {
    $vowels = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        switch ($str[$i]) {
            case 'a':
            case 'e':
            case 'i':
            case 'o':
            case 'u':
                $vowels++;
        }
    }

    return ($vowels >= 3) ? true : false;
}

function doubleLetter($str) {
    $double = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        if (($i + 1) < strlen($str)) {
            if ($str[$i] === $str[$i + 1]) {
                $double++;
            }
        }
    }

    return ($double !== 0) ? true : false;
}

function noBadStrings($str) {
    $bad_strings = 0;

    if (str_contains($str, 'ab') || str_contains($str, 'cd') || str_contains($str, 'pq') || str_contains($str, 'xy')) {
        $bad_strings++;
    }

    return $bad_strings === 0 ? true : false;
}

$input = getInput('./input.txt');
echo evaluateStrings($input);