<?php
if(isset($_FILES['myimage']['tmp_name'])){
    $path = "uploads/". $_FILES['myimage']['name'];
    move_uploaded_file($_FILES['myimage']['tmp_name'], $path);
}
?>