<?php
require_once "./components/connect.php";
require_once "./components/utilities.php";

if (!isset($_POST["title"])) {
    alertGoTo("非法進入", "./index.php");
    exit;
}

$shs_id= htmlspecialchars($_POST["shs-id"] );
$title= htmlspecialchars($_POST["title"]);
$author= htmlspecialchars($_POST["author"]);
$price= intval($_POST["price"]);
$genre_id= intval($_POST["genre"]);
$gender_id= intval($_POST["gender"]);
$company= htmlspecialchars($_POST["company"]);
$release_date= htmlspecialchars($_POST["release_date"]);
$format=htmlspecialchars($_POST["format"]);
$stock= htmlspecialchars($_POST["stock"]);
$desc_text=htmlspecialchars($_POST["desc_text"]);
$playlist=htmlspecialchars($_POST["playlist"]);

$timestamp = time();
$img=htmlentities($_FILES["myFile"]);
$ext = pathinfo($_FILES["myFile"]["name"][$i], PATHINFO_EXTENSION);
$img_name="{$shs_id}_{$timestamp}.{$ext}";
$file = "./img/{$newFile}";
if (move_uploaded_file($_FILES["myFile"]["tmp_name"][$i], $file)) {
// echo "<img src='{$file}'>";
array_push($imgs,$newFile);
} else {
array_push($imgs,null);
// echo "上傳失敗";
}

$status = ($stock == 0) ? 3 : (($release_date > $today = date("Y-m-d") ) ? 2 : 1);

$values=[$shs_id,$title,$author_id,$price,$genre_id,$gender_id,$company,$release_date,$format,$stock,$status,$desc_text,$playlist];

$sql = "INSERT INTO `vinyl` 
  (`shs_id` `title`, `author_id`,`price`,`genre_id`,`gender_id`,company,release_date,format,stock,status_id,desc_text,playlist) VALUES 
  (? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?);";

$sqlImg = "INSERT INTO `vinyl_img` 
  (`shs_id` `img_name`,`img_path`) VALUES 
  (? ,? ,? );";

$sqlAuthor="Insert Into vinyl_author (author) ($author)";  

// >> 避免注入SQL
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST["active"],$_POST["msgID"],$_POST["date_start"],$_POST["date_end"]]);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}
alterGoTo("新增活動成功","./pageMsgs.php?id={$_POST["msgID"]}")
?>