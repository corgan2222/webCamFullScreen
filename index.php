<?php 

// Set timezone 
date_default_timezone_set('Europe/Berlin'); 

if(isset($_GET["size"])){

    switch ($_GET["size"]) {
        case '400':
            $size="400_";
            break;
        
        case '800':
        $size="800_";
            break;
        
        case 'full':
            $size="";
            break;
        
        default:
            $size="400_";
            break;
    }

}else {
    $size="800_";
}


?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
  font: 400 15px/1.8 "Lato", sans-serif;
  color: #777;
}

.bgimg-1, .bgimg-2, .bgimg-3 {
  position: relative;
  opacity: 1;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}
.bgimg-1 {
  background-image: url("<?php echo  $size; ?>image.jpg");
  height: 100%;
}

.caption {
  position: absolute;
  left: 0;
  top: 85%;
  width: 100%;
  text-align: center;
  color: #000;
}

.caption span.border {
  background-color: #111;
  color: #fff;
  padding: 2px;
  font-size: 12px;
  letter-spacing: 3px;
}

h3 {
  letter-spacing: 1px;
  text-transform: uppercase;
  font: 10px "Lato", sans-serif;
  color: #111;
}
</style>
</head>
<?php  


$filename = 'image.jpg';

if (file_exists($filename)) {

    $created = date ("d.m | H:i", filemtime($filename));
    
    $size = FileSizeConvert(filesize($filename));
}


?>

<body>
<a href="https://www.knaak.org/wsl_image/image.jpg" target="_blank">
    <div class="bgimg-1">    
    <div class="caption">
        <span class="border"><?php echo $created; ?> | <?php echo $size ?></span>    
    </div>
    </div>
</a>
</body>
</html>

<?php
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
?>