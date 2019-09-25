
<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";

//danh sach danh muc san pham
$id = intval(getInput("id"));
$Editproduct = $db->fetchID("product",$id,"ProductId");

if (empty($Editproduct)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("product");
}

$menu = $db->fetchAll("menu");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # code...
  $data = [
    "ProductName" => postInput("name"),
    "MenuId" => postInput("MenuId"),
    "Price" => postInput("Price")
  ];
  $error = [];
  if (postInput("name") == '') {
    # code...
    $error["name"] = "Moi ban nhap du ten san pham";

  }
  if (postInput("MenuId") == '') {
    # code...
    $error["MenuId"] = "Moi ban chon danh muc";

  }
  if (postInput("Price") == '') {
    # code...
    $error["Price"] = "Moi ban nhap gia";

  }
  
  if ( ! isset($_FILES["Image"])) {
    # code...
    $error["Image"] = "Moi ban chon anh dai dien san pham";
  }

  if (empty($error)) {
    if (isset($_FILES["Image"])) {
      # code...
      $file_name = $_FILES["Image"]["name"];
      $file_type = $_FILES["Image"]["type"];
      $file_tmp = $_FILES["Image"]['tmp_name'];
      $file_error = $_FILES["Image"]['error'];
      if ($file_error == 0) {
        # code...
        $part = ROOT ."product/";

        $data["Image"] = $file_name;
      }
    }
    $update = $db->update("product",$data,array("ProductId"=>$id));
    if ($update > 0) {
      # code...
      move_uploaded_file($file_tmp, $part.$file_name);
      $_SESSION['success'] = "Cap nhat thanh cong";
      redirectAdmin("product");
    } else {
      $_SESSION['error'] = "Cap nhat that bai";
      redirectAdmin("product");
    }
  }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">

  <!-- Page Content -->
  <h1>Sửa thông tin sản phẩm </h1>
  <hr>


</div>
<div class="row">
  <div class="col-md-12">
    <form action="" method="POST" style="padding: 0 10px;" enctype="multipart/form-data">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
        <div class="col-sm-10">
          <select class="form-control col-md-8" name="MenuId">
            <option value="">Mời bạn chọn danh mục sản phẩm</option>
            <?php foreach ($menu as $item): ?>
              <option value="<?php echo $item["MenuId"] ?>" <?php echo ($Editproduct['MenuId'] == $item['MenuId']) ? "selected" : '' ?>><?php echo $item["MenuName"] ?></option>
            <?php endforeach ?>
          </select>
          <?php if (isset($error['MenuId'])): ?>
            <p class="alert alert-danger"><?php echo $error['MenuId'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tên sản phẩm</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="name" name="name" value="<?php echo $Editproduct['ProductName'] ?>">
          <?php if (isset($error['name'])): ?>
            <p class="alert alert-danger"><?php echo $error['name'] ?></p>
          <?php endif ?>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Giá sản phẩm</label>
        <div class="col-sm-10">
          <input type="Number" class="form-control" placeholder="0" name="Price" value="<?php echo $Editproduct['Price'] ?>">
          <?php if (isset($error['Price'])): ?>
            <p class="alert alert-danger"><?php echo $error['Price'] ?></p>
          <?php endif ?>
        </div>
      </div>

      <div class="form-group row">

        <label class=" col-form-label">Hình ảnh</label>
        <div class="col-sm-4">
          <input type="file" class="form-control" name="Image" accept="image/*" onchange="loadFile(event)">   
          <?php if (isset($error['Image'])): ?>
            <p class="alert alert-danger"><?php echo $error['Image'] ?></p>
          <?php endif ?>
          <img src="<?php echo uploads() ?>product/<?php echo $Editproduct['Image'] ?>" width="120px" id="output">  
          <script>
            var loadFile = function(event) {
              var output = document.getElementById('output');
              output.src = URL.createObjectURL(event.target.files[0]);
            };
          </script>   
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </div>
    </form>
  </div> 
</div>
<!-- /.container-fluid -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>