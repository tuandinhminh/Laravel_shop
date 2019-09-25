
<?php 
$open = "admin";
require_once __DIR__. "/../../autoload/autoload.php";

//danh sach danh muc san pham
 $data = [
    "AdminName" => postInput("name"),
    "Email" => postInput("email"),
    "Password" => md5(postInput("password")),
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
  else{
    $is_check = $db->fetchOne("admin"," Email = '".$data['email']."' ");
    if ($is_check != NULL) {
      # code...
      $error['email'] = "email da ton tai";

    }
  }
  if (postInput("password") == '') {
    # code...
    $error["password"] = "Moi ban nhap mat khau";

  }
  
  if ($data['Password'] != MD5(postInput('re_password'))) {
    # code...
    $error['re_password'] = "mat khau khon khop";
  }

  if (empty($error)) {

    $id_insert = $db->insert("admin",$data);
    if ($id_insert) {
      # code...
      $_SESSION['success'] = "Them moi thanh cong";
      redirectAdmin("admin");
    }
    else {
      $_SESSION['error'] = "Them moi that bai";
      redirectAdmin("admin");
    }
  }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">

  <!-- Page Content -->
  <h1>Thêm mới Admin </h1>
  <hr>


</div>
<div class="row">
  <div class="col-md-12">
    <form action="" method="POST" style="padding: 0 10px;" enctype="multipart/form-data" >

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Họ và tên</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="name" name="name" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>">
          <?php if (isset($error["name"])): ?>
            <p class="text-danger"> <?php echo $error["name"]; ?> </p>
          <?php endif ?>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" placeholder="tuandinhminh1234@gmail.com" name="email" value="<?php echo isset($data['email']) ? $data['email'] : '' ?>" >
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
          <input type="password" class="form-control" placeholder="******" name="re_password" required="">
          <?php if (isset($error["re_password"])): ?>
            <p class="text-danger"> <?php echo $error["re_password"]; ?> </p>
          <?php endif ?>
        </div>
      </div>
      

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-10">
          <select class="form-group" name="type">
            <option value="1" <?php echo isset($data['type']) && $data['type'] == 1 ? 'selected' : '' ?>>Staff</option>
            <option value="2" <?php echo isset($data['type']) && $data['type'] == 2 ? 'selected' : '' ?>>Admin</option>
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