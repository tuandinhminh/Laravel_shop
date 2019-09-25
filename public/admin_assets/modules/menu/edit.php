
<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editmenu = $db->fetchID("menu",$id,"MenuId");

if (empty($Editmenu)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("menu");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # code...
  $data = [
    "MenuName" => postInput("MenuName")
  ];
  $error = [];
  if (postInput("MenuName") == '') {
    # code...
    $error["MenuName"] = "Moi ban nhap du ten danh muc";
  }
  if (empty($error)) {
    // kiem tra
    # code...
    if ($Editmenu["MenuName"] != $data["MenuName"]) {
      # code...
      $isset = $db->fetchOne("menu","MenuName = '".$data["MenuName"]."'");
      if (count($isset) > 0) {
      # code...
        $_SESSION['error'] = "Tên danh mục đã tồn tại !";
      } else {
      # code...
        $id_update = $db->update("menu",$data,array("MenuId"=>$id));
        if ($id_update > 0) {
      # code...
          $_SESSION['success'] = "cập nhật thành công";
          redirectAdmin("menu");
        }
        else { 
          $_SESSION['error'] = "cập nhật thất bại";
          redirectAdmin("menu");
        }
      }
    }
    else {
      $id_update = $db->update("menu",$data,array("MenuId"=>$id));
      if ($id_update > 0) {
      # code...
        $_SESSION['success'] = "cập nhật thành công";
        redirectAdmin("menu");
      }
      else {
        $_SESSION['error'] = "cập nhật thất bại";
        redirectAdmin("menu");
      }
    }
    
  }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb"> 
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Danh mục</li>
    <li class="breadcrumb-item active">Thêm mới</li>
  </ol>

  <!-- Page Content -->
  <h1>Thêm mới danh mục </h1>
  <hr>


</div>
<div class="row">
  <div class="col-md-12">
    <form action="" method="POST" style="padding: 0 10px;">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tên danh mục</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="MenuName" name="MenuName" value=" <?php echo $Editmenu['MenuName'] ?> ">
          <?php if (isset($error['MenuName'])): ?>
            <p class="alert alert-danger"><?php echo $error['MenuName'] ?></p>
          <?php endif ?>
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