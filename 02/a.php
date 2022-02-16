<?php

function getInput($filename) {
    $file = fopen($filename, 'r');
    if ($file) {
        $data = fread($file, filesize($filename));
        fclose($file);
    }

    return $data;
}

$total_paper = 0;
$input = getInput('./input.txt');
$presents = explode("\r\n", $input);

foreach ($presents as $present) {
    $dimensions = explode('x', $present);
    
    $length = $dimensions[0];
    $width = $dimensions[1];
    $height = $dimensions[2];

    $sides = array();
    $sides[0] = $length * $width;
    $sides[1] = $length * $height;
    $sides[2] = $width * $height;

    if ($sides[0] <= $sides[1] && $sides[0] <= $sides[2]) {
        $smallest_side = $sides[0];
    } elseif ($sides[1] <= $sides[0] && $sides[1] <= $sides[2]) {
        $smallest_side = $sides[1];
    } elseif ($sides[2] <= $sides[1] && $sides[2] <= $sides[0]) {
        $smallest_side = $sides[2];
    }
    
    $surface_area = 2 * ($sides[0] + $sides[1] + $sides[2]);
    $total_paper += $surface_area + $smallest_side;
}

echo $total_paper;