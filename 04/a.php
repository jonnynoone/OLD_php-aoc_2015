<?php

$secret_key = 'bgvyzdsv';

$i = 0;
$found = null;

while (!$found) {
    $i++;
    echo $i . "\n";
    $md5_hash = md5($secret_key . $i);

    $found = str_starts_with($md5_hash, '00000');
}

echo "\nAnswer: ${i}";