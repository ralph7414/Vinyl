<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新增黑膠唱片</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style></style>
  </head>
  <body>
    <div class="container mt-3">
      <h1>增加黑膠唱片</h1>
      <form action="./doAdd.php" method="post" enctype="multipart/form-data" >
        <div class="input-group mb-1">
          <span class="input-group-text">唱片</span>
          <input required name="tile" type="text" class="form-control" placeholder="唱片名稱">
        </div>
        <div class="input-group mb-1">
          <span class="input-group-text">藝術家</span>
          <input required name="author" type="text" class="form-control" placeholder="藝術家">
        </div>
        <div class="input-group mb-1">
          <span class="input-group-text">國家</span>
          <input required name="country" type="text" class="form-control" placeholder="使用者姓名">
        </div>
        <div class="input-group mb-1">
          <span class="input-group-text">價格</span>
          <input required name="price" type="text" class="form-control" placeholder="使用者姓名">
        </div>

        <div class="">
            <div class="input-group mb-1">
                <span class="input-group-text">風格</span>
                <input required name="genre" type="text" class="form-control" placeholder="使用者姓名">
            </div>
            <div class="input-group mb-1">
                <span class="input-group-text">類別</span>
                <input required name="gender" type="text" class="form-control" placeholder="使用者姓名">
            </div>
        </div>

        <div class="input-group mb-1">
          <span class="input-group-text">規格</span>
          <input required name="format" type="text" class="form-control" placeholder="使用者姓名">
        </div>

        <div class="input-group mb-1">
          <span class="input-group-text">出版日期</span>
          <input required name="release_date" type="data" class="form-control" placeholder="使用者姓名">
        </div>
        <div class="input-group mb-1">
          <span class="input-group-text">庫存</span>
          <input required name="release_date" type="data" class="form-control" placeholder="使用者姓名">
        </div>

        <div class="input-group mb-1">
          <input name="myFile" type="file" class="form-control">
        </div>
        <div class="mt-1 text-end">
          <button type="submit" class="btn btn-info btn-send">送出</button>
          <a class="btn btn-primary" href="./index.php">取消</a>
        </div>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script></script>
  </body>
</html>