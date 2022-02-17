<?php

function getInput($filename) {
    $file = fopen($filename, 'r');
    if ($file) {
        $data = fread($file, filesize($filename));
        fclose($file);
    }

    return $data;
}

function processLocation() {
    global $location;
    global $houses;
    global $houses_visited;
    $visited = false;

    foreach ($houses as $house) {
        if ($location === $house) {
            $visited = true;
        }
    }

    if (!$visited) {
        array_push($houses, $location);
        $houses_visited++;
    }
}

$input = getInput('./input.txt');

$location = ['x' => 0, 'y' => 0];
$houses = array($location);
$houses_visited = 1;

for ($i = 0; $i < strlen($input); $i++) {
    switch ($input[$i]) {
        case '^':
            $location['y']++;
            break;
        case '>':
            $location['x']++;
            break;
        case 'v':
            $location['y']--;
            break;
        case '<':
            $location['x']--;
            break;
    }

    processLocation();
}

echo "Houses visited: ${houses_visited}";