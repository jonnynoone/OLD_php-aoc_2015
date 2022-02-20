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
    return (containsDoublePair($str) && containsDoubleLetter($str)) ? true : false;
}

function containsDoublePair($str) {
    $doubles = 0;
    $pairs = array();

    for ($i = 0; $i < strlen($str); $i++) {
        if (($i + 1) < strlen($str)) {
            array_push($pairs, $str[$i] . $str[$i + 1]);
        }
    }

    while ($pairs) {
        $current_pair = array_shift($pairs);

        for ($j = 1; $j < count($pairs); $j++) {
            if ($current_pair === $pairs[$j]) {
                $doubles++;
            }
        }
    }

    return ($doubles !== 0) ? true : false;
}

function containsDoubleLetter($str) {
    $double = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        if (($i + 2) < strlen($str)) {
            if ($str[$i] === $str[$i + 2]) {
                $double++;
            }
        }
    }
    
    return ($double !== 0) ? true : false;
}

$input = getInput('./input.txt');
echo evaluateStrings($input);