<?php
// session_start();
// if(!isset($_SESSION["user"])){
//     header("location: ./login.php");
//     exit;
// }

require_once "./components/connect.php";
require_once "./components/utilities.php";

$perPage = 20;
$page = intval($_GET["page"] ?? 1);
$pageStart = ($page - 1) * $perPage;

$sql = "SELECT vinyl.id AS id,title,author_id,vinyl_author.author AS author,price,stock,vinyl_status.status AS status FROM `vinyl` JOIN vinyl_author ON vinyl_author.id = vinyl.author_id JOIN vinyl_status on vinyl_status.id = vinyl.status_id WHERE `status_id` = 1 LIMIT $perPage OFFSET $pageStart";
$sqlAll = "SELECT vinyl.id AS id,title,author_id,vinyl_author.author AS author,price,stock,status_id FROM `vinyl` JOIN vinyl_author ON vinyl_author.id = vinyl.author_id WHERE `status_id` = 1";

try {
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmtAll = $pdo->prepare($sqlAll);
  $stmtAll->execute();
  $totalCount = $stmtAll->rowCount();
} catch (PDOException $e) {
  echo "系統錯誤，請恰管理人員<br>";
  echo "錯誤: " . $e->getMessage();
  exit;
}

$totalPage = ceil($totalCount / $perPage);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>黑膠唱片</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <style>
    .msg {
      display: flex;
      margin-bottom: 2px;
    }
    .id {
      width: 50px;
    }
    .title {
      flex: 1;
    }
    .release_date{
      width: 105px;
    }
    .author{
      width: 150px;
      text-align: center;
    }
    .price,.stock,.status{
      width: 100px;
      text-align: center;
    }

    .time {
      width: 100px;
    }

    .wpx200 {
      width: 200px;
    }
  </style>
</head>

<body>
  <div class="container mt-3">
    <h1>黑膠商品列表</h1>
    <div class="my-2 d-flex">
      <span class="me-auto">目前共 <?= $totalCount ?> 筆資料</span>
      <a class="btn btn-primary btn-sm btn-add" href="./vinylAdd.php">增加黑膠唱片</a>
    </div>
    <div class="msg text-bg-dark ps-1">
      <div class="id">#</div>
      <div class="title">專輯</div>
      <div class="author">藝術家</div>
      <div class="price">價格</div>
      <div class="stock">庫存</div>
      <div class="status">狀態</div>
      <div class="time text-center">操作</div>
    </div>

    <?php foreach ($rows as $index => $row): ?>
      <div class="msg">
        <div class="id"><?= $index + 1 + ($page - 1) * $perPage ?></div>
        <div class="title"><?= $row["title"] ?></div>
        <div class="author"><?= $row["author"] ?></div>
        <div class="company"><?= $row["company"] ?></div>
        <div class="price"><?= $row["price"] ?></div>
        <div class="stock"><?= $row["stock"] ?></div>
        <div class="status"><?= $row["status"] ?></div>


        <div class="time">
          <div class="btn btn-danger btn-sm btn-del" data-id="<?= $row["id"] ?>">刪除</div>
          <a class="btn btn-warning btn-sm" href="./vinylUpdate.php?id=<?= $row["id"] ?>">修改</a>
        </div>
      </div>
    <?php endforeach; ?>


    <ul class="pagination justify-content-center">
      <?php for($i=1;$i<=$totalPage;$i++): ?>
        <li class="page-item <?= $page == $i ? "active" : "" ?>">
          <?php 
            $link="?page={$i}";
            // if($cid>0) $link .= "&cid={$cid}";
          ?>
          <a class="page-link" href="<?= $link ?>"><?=$i?></a>
        </li>
      <?php endfor; ?>
    </ul>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
  <script>
    const btnDel = document.querySelectorAll('.btn-del');
    btnDel.forEach((btn) => {
      btn.addEventListener("click", doConfirm);
    })

    function doConfirm(e) {
      const btn = e.target
      // console.log(btn.dataset.id);
      if (confirm(btn.dataset.name+" 確定刪除嗎?")) {
        window.location.href = `./doDeleteVinyl.php?id=${btn.dataset.id}`
      }
    }
  </script>
</body>

</html>