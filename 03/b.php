<?php

function getInput($filename) {
    $file = fopen($filename, 'r');
    if ($file) {
        $data = fread($file, filesize($filename));
        fclose($file);
    }

    return $data;
}

function sortDirections($directions) {
    global $santa_directions;
    global $robo_directions;

    for ($i = 0; $i < strlen($directions); $i++) {
        if ($i % 2 === 0) {
            array_push($santa_directions, $directions[$i]);
        } else {
            array_push($robo_directions, $directions[$i]);
        }
    }
}

function parseDirections($directions, &$location_arr) {
    for ($i = 0; $i < count($directions); $i++) {
        switch ($directions[$i]) {
            case '^':
                $location_arr['y']++;
                break;
            case '>':
                $location_arr['x']++;
                break;
            case 'v':
                $location_arr['y']--;
                break;
            case '<':
                $location_arr['x']--;
                break;
        }
    
        processLocation($location_arr);
    }
}

function processLocation($location) {
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

$santa_directions = array();
$robo_directions = array();

sortDirections($input);

$santa_location = ['x' => 0, 'y' => 0];
$robo_location = ['x' => 0, 'y' => 0];
$houses = array(['x' => 0, 'y' => 0]);
$houses_visited = 1;

parseDirections($santa_directions, $santa_location);
parseDirections($robo_directions, $robo_location);

echo "Houses visited: ${houses_visited}";