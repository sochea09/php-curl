<form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image"/>
    <input type="submit" value="Post"/>
</form>

<?php
if(isset($_FILES['image']['tmp_name'])){
    $ch = curl_init();

    $cfile = new CURLFile($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
    $data = array("myimage"=>$cfile);

    curl_setopt($ch, CURLOPT_URL, "http://localhost/php-curl/upload/upload.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);

    if($response == true){
        echo "File posted";
    }else{
        echo "Error: " . curl_error($ch);
    }

}
?>