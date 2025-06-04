<?php
require_once "./components/connect.php";
require_once "./components/utilities.php";

$sqlGenre = "SELECT * FROM vinyl_genre";
$sqlGender = "SELECT * FROM vinyl_gender";


try {
  $stmt = $pdo->prepare($sqlGenre);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmtGender = $pdo->prepare($sqlGender);
  $stmtGender->execute();
  $rowsGender = $stmtGender->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // echo "錯誤: {{$e->getMessage()}} <br>";
  // exit;
  $errorMsg = $e->getMessage();
}
?>

<!-- <pre><?php print_r($rowsGender); ?></pre> -->

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>新增黑膠唱片</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <style></style>
</head>

<body>
  <div class="container mt-4">
    <h1 class="mb-4">增加黑膠唱片</h1>
    <form action="./doAdd.php" method="post" enctype="multipart/form-data">
      <!-- 唱片 -->
      <div class="mb-3">
        <label class="form-label">唱片名稱</label>
        <input required name="title" type="text" class="form-control" placeholder="唱片名稱">
      </div>

      <!-- 藝術家 / 公司 / 價格 -->
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label">藝術家</label>
          <input required name="author" type="text" class="form-control" placeholder="藝術家">
        </div>
        <div class="col-md-4">
          <label class="form-label">公司</label>
          <input required name="company" type="text" class="form-control" placeholder="公司名稱">
        </div>
        <div class="col-md-4">
          <label class="form-label">價格</label>
          <input required name="price" type="number" class="form-control" placeholder="價格">
        </div>
      </div>

      <!-- 風格 / 類別 -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">風格</label>
          <select name="genre" id="genre" class="form-select" required>
            <option value selected disabled>請選擇</option>
            <?php foreach ($rows as $row): ?>
              <option value="<?= $row["id"] ?>"><?= $row["genre"] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">類別</label>
          <select name="gender" id="gender" class="form-select" required>
            <option value selected disabled>請選擇</option>
          </select>
        </div>
      </div>

      <!-- 發行日期 / 規格 / 庫存 -->
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label">發行日期</label>
          <input name="release_date" type="date" class="form-control">
        </div>
        <div class="col-md-4">
          <label class="form-label">規格</label>
          <input required name="format" type="text" class="form-control" placeholder="如：LP、EP...">
        </div>
        <div class="col-md-4">
          <label class="form-label">庫存</label>
          <input required name="stock" type="number" class="form-control" placeholder="庫存數量">
        </div>
      </div>

      <!-- 上傳檔案 -->
      <div class="mb-3">
        <label class="form-label">上傳圖片</label>
        <input name="myFile" type="file" class="form-control">
      </div>

      <!-- 按鈕 -->
      <div class="text-end">
        <button type="submit" class="btn btn-info">送出</button>
        <a class="btn btn-secondary" href="./index.php">取消</a>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
  <script>

    // 放你的 JS 代碼（包括 event listener）
    const genderSelect = document.getElementById("gender");
    const genreSelect = document.getElementById("genre");

    const genderOptionsRaw = <?= json_encode($rowsGender) ?>;

    // 轉換為 genre_id => [gender, gender, ...]
    const genderOptions = {};
    genderOptionsRaw.forEach(row => {
      const genreId = row.genre_id;
      if (!genderOptions[genreId]) {
        genderOptions[genreId] = [];
      }
      genderOptions[genreId].push({
        id: row.id,
        gender: row.gender
      });
    });

    genreSelect.addEventListener("change", function () {


      const genreId = this.value;
      const genders = genderOptions[genreId] || [];

      console.log(genreId);

      // 清空原本選項
      genderSelect.innerHTML = '<option value selected disabled>請選擇</option>';

      // 加入新的選項
      genders.forEach(g => {
        const opt = document.createElement("option");
        opt.value = g.id;
        opt.textContent = g.gender;
        genderSelect.appendChild(opt);
      });
    });



  </script>
</body>

</html>