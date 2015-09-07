<?php

if(isset($_POST['name'], $_POST['age'])){
    $db = new Mysqli("localhost", "root", "", "postdata");
    $name = $db->real_escape_string($_POST['name']);
    $age = (int)$_POST['age'];
    $query = "INSERT INTO data SET mydata='$name, $age'";
    $db->query($query);
}

?>