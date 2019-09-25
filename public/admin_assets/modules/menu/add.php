
<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";

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
    
    $isset = $db->fetchOne("menu"," MenuName = '".$data["MenuName"]."'");
    if (count($isset) > 0) {
      # code...
      $_SESSION['error'] = "Tên danh mục đã tồn tại !";
    } else {
      # code...
      $id_insert = $db->insert("menu",$data);
      if ($id_insert > 0) {
      # code...
        $_SESSION['success'] = "thêm mới thành công";
        redirectAdmin("menu");
      }
      else {
        $_SESSION['error'] = "thêm mới thất bại";
      }
    }
    
  }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">

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
          <input type="text" class="form-control" placeholder="MenuName" name="MenuName">
          <?php if (isset($error["MenuName"])): ?>
            <p class="alert alert-danger"><?php echo $error["MenuName"] ?></p>
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