<?php

    $data = array("name" => "john", "age" => 31);
    $string = http_build_query($data);

    $ch = curl_init("http://localhost/php-curl/posting-data/data.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
?>
