<?php 
$open = "discount";
require_once __DIR__. "/../../autoload/autoload.php";

$p = isset($_GET['page']) ? $_GET['page'] : 1;


$sql = "SELECT discount.* FROM discount ORDER BY DiscountId DESC";
$discount = $db->fetchJone("DiscountId","discount",$sql,$p,3,true);
if (isset($discount['page'])) {
  # code...
  $sotrang = $discount['page'];
  unset($discount['page']);
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">


  <!-- Page Content -->
  <h1>Danh sách discount 
    <a href="add.php" class="btn btn-success">Thêm mới</a>
  </h1>

  <div class="clearfix"></div>
  <!-- in thong bao -->
  <?php if (isset($_SESSION['success'])): ?>
    <p class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']) ?></p>
  <?php endif ?>
  <?php if (isset($_SESSION['error'])): ?>
    <p class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']) ?></p>
  <?php endif ?>
  <hr>

  <hr>

  <div class="table-responsive">
    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

      <div class="row">
        <div class="col-sm-12">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;text-align: center;" >
            <thead>
              <tr role="row">
                <th >STT</th>  
                <th>Name</th>         
                <th >StartDate</th>
                <th>EndDate</th>
                <th>Discount Rate</th>
                <th >Action</th>

              </tr>
            </thead>
            <tbody>
              <?php $stt =1 ;foreach ($discount as $item): ?>
              <tr role="row" class="odd">
                <td class="sorting_1"><?php echo $stt; ?></td>
                <td><?php echo $item['DiscountName'] ?></td>
                <td><?php echo $item['StartDate'] ?></td>
                <td><?php echo $item['EndDate'] ?></td>
                <td><?php echo $item['DiscountRate'] ?></td>
                <td>
                  <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['DiscountId'] ?>">Sửa</a>
                  <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['DiscountId'] ?>">Xóa</a>
                </td>

              </tr>
              <?php $stt++; endforeach ?>

            </tbody>
          </table>
          <div style="float: right; ">
            <nav aria-label="Page navigation" class="clearfix">
              <ul class="pagination">
                <li>
                  <a href="" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for ($i = 1 ;$i <= $sotrang ; $i++): ?>
                  
                  <li class="<?php echo ($i == $p) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor ?>
                <li>
                  <a href="" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
            
          </div>

        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>