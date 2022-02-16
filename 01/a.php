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

$floor = 0;
for ($i = 0; $i < strlen($input); $i++) {
    if ($input[$i] === "(") {
        $floor++;
    } elseif ($input[$i] === ")") {
        $floor--;
    }
}

echo $floor;