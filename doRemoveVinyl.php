<?php 
// ? 刪除會員
// ? 新增會員
require_once "./components/connect.php";
require_once "./components/Utilities.php";

if (!isset($_GET["id"])) {
    alertGoTo("非法進入", "./index.php");
    exit;
}

$id=$_GET["id"];

$sql="UPDATE vinyl SET status_id = 0 where id = ?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}
alertGoTo("下架黑膠唱片成功", "./index.php");


?>