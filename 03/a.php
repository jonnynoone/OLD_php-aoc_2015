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

$houses_visited = 1;
$location = ['x' => 0, 'y' => 0];

$houses = array($location);

function checkLocation() {
    global $location;
    global $houses;

    foreach ($houses as $house) {
        if ($location === $house) {
            return true;
        }
    }
}

for ($i = 0; $i < strlen($input); $i++) {
    switch ($input[$i]) {
        case '^':
            $location['y']++;
            $visited = checkLocation(); 
            if (!$visited) {
                array_push($houses, $location);
                $houses_visited++;
            }
            break;
        case '>':
            $location['x']++;
            $visited = checkLocation(); 
            if (!$visited) {
                array_push($houses, $location);
                $houses_visited++;
            }
            break;
        case 'v':
            $location['y']--;
            $visited = checkLocation(); 
            if (!$visited) {
                array_push($houses, $location);
                $houses_visited++;
            }
            break;
        case '<':
            $location['x']--;
            $visited = checkLocation(); 
            if (!$visited) {
                array_push($houses, $location);
                $houses_visited++;
            }
            break;
    }
}

echo "Houses visited: ${houses_visited}";