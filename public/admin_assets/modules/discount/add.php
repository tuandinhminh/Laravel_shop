
<?php 
$open = "discount";
require_once __DIR__. "/../../autoload/autoload.php";

//danh sach danh muc san pham

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # code...
 $data = [
  "DiscountName" => postInput("name"),
  "StartDate" => postInput("start"),
  "EndDate" => postInput("end"),
  "DiscountRate" => postInput("rate")
];
  //bat loi
$error = [];
if (postInput("name") == '') {
    # code...
  $error["name"] = "Moi ban nhap ten";

}
if (postInput("start") == '') {
    # code...
  $error["start"] = "Moi ban nhap ngay bat dau";

}
if (postInput("end") == '' || postInput("end") <= postInput("start") ) {
    # code...
  $error["end"] = "ngay ket thuc khong hop le";

}
if (postInput("rate") == '' ) {
    # code...
  $error["rate"] = "Moi ban nhap % giam";

}

if (empty($error)) {

  $id_insert = $db->insert("discount",$data);
  if ($id_insert) {
      # code...
    $_SESSION['success'] = "Them moi thanh cong";
    redirectAdmin("discount");
  }
  else {
    $_SESSION['error'] = "Them moi that bai";
    redirectAdmin("discount");
  }
}
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">

  <!-- Page Content -->
  <h1>Thêm mới discount </h1>
  <hr>


</div>
<div class="row">
  <div class="col-md-12">
    <form action="" method="POST" style="padding: 0 10px;" enctype="multipart/form-data" >

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Tên CTKM</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="name" name="name" value="<?php echo isset($data['DiscountName']) ? $data['DiscountName'] : '' ?>">
          <?php if (isset($error["name"])): ?>
            <p class="text-danger"> <?php echo $error["name"]; ?> </p>
          <?php endif ?>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Start</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" name="start" value="<?php echo isset($data['StartDate']) ? $data['StartDate'] : '' ?>" >
          <?php if (isset($error["start"])): ?>
            <p class="text-danger"> <?php echo $error["start"]; ?> </p>
          <?php endif ?>

        </div>
      </div>

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">End</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" name="end" value="<?php echo isset($data['EndDate']) ? $data['EndDate'] : '' ?>">
          <?php if (isset($error["end"])): ?>
            <p class="text-danger"> <?php echo $error["end"]; ?> </p>
          <?php endif ?>

        </div>
      </div>

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Rate</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" placeholder="10" name="rate" required="" value="<?php echo isset($data['DiscountRate']) ? $data['DiscountRate'] : '' ?>">
          <?php if (isset($error["rate"])): ?>
            <p class="text-danger"> <?php echo $error["rate"]; ?> </p>
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