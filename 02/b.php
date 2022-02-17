<?php

function getInput($filename) {
    $file = fopen($filename, 'r');
    if ($file) {
        $data = fread($file, filesize($filename));
        fclose($file);
    }

    return $data;
}

$input = getInput('./input.txt');
$presents = explode("\r\n", $input);

$total_ribbon = 0;

foreach ($presents as $present) {
    $dimensions = explode('x', $present);
    
    $length = $dimensions[0];
    $width = $dimensions[1];
    $height = $dimensions[2];
    
    if ($length >= $width && $length >= $height) {
        $wrap = $width * 2 + $height * 2;
    } elseif ($width >= $length && $width >= $height) {
        $wrap = $length * 2 + $height * 2;
    } elseif ($height >= $width && $height >= $length) {
        $wrap = $length * 2 + $width * 2;
    }

    $bow = $length * $width * $height;
    $ribbon = $wrap + $bow;
    $total_ribbon += $ribbon;
}

echo $total_ribbon;