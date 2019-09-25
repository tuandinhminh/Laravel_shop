
<?php 
$open = "admin";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editadmin = $db->fetchID("admin",$id,"id");

if (empty($Editadmin)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("admin");
}

//danh sach danh muc san pham
$data = [
  "AdminName" => postInput("name"),
  "Email" => postInput("email"),
  "AdminType" => postInput("type")
];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # code...

  //bat loi
  $error = [];
  if (postInput("name") == '') {
    # code...
    $error["name"] = "Moi ban nhap ten";

  }
  if (postInput("email") == '') {
    # code...
    $error["email"] = "Moi ban nhap email";

  }
  else {
    if (postInput('email') != $Editadmin['email']) {
    # code...
      $is_check = $db->fetchOne("admin"," Email = '".$data['email']."' ");
      if ($is_check != NULL) {
      # code...
        $error['email'] = "email da ton tai";

      }

    }

  }

  if (postInput('password') != NULL && postInput('re_password') != NULL) {
     # code...
    if (postInput('password') != postInput('re_password')) {
      # code...
      $error['re_password'] = "mat khau thay doi khong khop";
    }
    else {
      $data['Password'] = md5(postInput('password'));
    }
  } 

  if (empty($error)) {

    $id_update = $db->update("admin",$data,array("id" => $id));
    if ($id_update > 0) {
      # code...
      $_SESSION['success'] = "Cap nhat thanh cong";
      redirectAdmin("admin");
    }
    else {
      $_SESSION['error'] = "Cap nhat that bai";
      redirectAdmin("admin");
    }
  }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">

  <!-- Page Content -->
  <h1>Sửa thông tin Admin </h1>
  <hr>


</div>
<div class="row">
  <div class="col-md-12">
    <form action="" method="POST" style="padding: 0 10px;" enctype="multipart/form-data" >

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Họ và tên</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="name" name="name" value="<?php echo isset($Editadmin['AdminName']) ? $Editadmin['AdminName'] : '' ?>">
          <?php if (isset($error["name"])): ?>
            <p class="text-danger"> <?php echo $error["name"]; ?> </p>
          <?php endif ?>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" placeholder="tuandinhminh1234@gmail.com" name="email" value="<?php echo isset($Editadmin['Email']) ? $Editadmin['Email'] : '' ?>" >
          <?php if (isset($error["email"])): ?>
            <p class="text-danger"> <?php echo $error["email"]; ?> </p>
          <?php endif ?>

        </div>
      </div>

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" placeholder="******" name="password">
          <?php if (isset($error["password"])): ?>
            <p class="text-danger"> <?php echo $error["password"]; ?> </p>
          <?php endif ?>

        </div>
      </div>

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Retype Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" placeholder="******" name="re_password" >
          <?php if (isset($error["re_password"])): ?>
            <p class="text-danger"> <?php echo $error["re_password"]; ?> </p>
          <?php endif ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">type</label>
        <div class="col-sm-10">
          <select class="form-group" name="type">
            <option value="1" <?php echo isset($Editadmin['AdminType']) && $Editadmin['AdminType'] == 1 ? 'selected' : '' ?>>Staff</option>
            <option value="2" <?php echo isset($Editadmin['AdminType']) && $Editadmin['AdminType'] == 2 ? 'selected' : '' ?>>Admin</option>
          </select>
          <?php if (isset($error["type"])): ?>
            <p class="text-danger"> <?php echo $error["type"]; ?> </p>
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