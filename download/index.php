<?php
class Download{

    const URL_MAX_LENGTH = 2050;

    //clean url
    protected function cleanUrl($url){
        if(isset($url)){
            if(!empty($url)){
                if(strlen($url) < self::URL_MAX_LENGTH){
                    return strip_tags($url);
                }
            }
        }
    }

    //is Url
    protected function isUrl($url){
        $url = $this->cleanUrl($url);
        if(isset($url)){
            if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)){
                return $url;
            }
        }
    }

    //return extension
    protected function returnExtension($url){
        if($this->isUrl($url)){
            $end = end(preg_split("/[.]+/", $url));
            if(isset($end)){
                return $end;
            }
        }
    }

    //download file
    public function downloadFile($url){
        if($this->isUrl($url)){
            $extension = $this->returnExtension($url);
            if($extension){

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // false return to browser
                $return = curl_exec($ch);
                curl_close($ch);

                $destination = "download/file.$extension";
                $file = fopen($destination, "w+");
                fputs($file, $return);
                if(fclose($file)){
                    echo "File downloaded";
                }
            }
        }
    }
}

$obj = new Download();
if(isset($_POST['url'])){ $url = $_POST['url']; }

?>

<form action="index.php" method="post">
    <input type="text" name="url" maxlength="2000"/>
    <input type="submit" value="Download"/>
</form>

<?php if(isset($url)){ $obj->downloadFile($url); } ?>