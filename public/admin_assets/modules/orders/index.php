<?php 
$open = "orders";
require_once __DIR__. "/../../autoload/autoload.php";

$p = isset($_GET['page']) ? $_GET['page'] : 1;


$sql = "SELECT orders.*,customer.* FROM orders LEFT JOIN customer ON customer.CustomerId = orders.CustomerId ORDER BY OrderId DESC";
$orders = $db->fetchJone("OrderId","orders",$sql,$p,3,true);
if (isset($orders['page'])) {
  # code...
  $sotrang = $orders['page'];
  unset($orders['page']);
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">


  <!-- Page Content -->
  <h1>Danh sách orders 
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

  <div class="table-responsive">
    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

      <div class="row">
        <div class="col-sm-12">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;text-align: center;" >
            <thead>
              <tr role="row">
                <th >STT</th>           
                <th >Name</th>
                <th>SDT</th>
                <th>D.O.B</th>
                <th>status</th>
                <th >Action</th>

              </tr>
            </thead>
            <tbody>
              <?php $stt =1 ;foreach ($orders as $item): ?>
              <tr role="row" class="odd">
                <td class="sorting_1"><?php echo $stt; ?></td>
                <td><?php echo $item['CustomerName'] ?></td>
                <td><?php echo $item['PhoneNumber'] ?></td>
                <td><?php echo $item['DateOfBirth'] ?></td>
                <td>
                  <a href="status.php?id=<?php echo $item['OrderId'] ?>" class="btn btn-<?php echo $item['Status'] == 0 ? 'danger' : 'info' ?>"><?php echo $item['Status'] == 0 ? 'Chưa xử lý' : 'đã xử lý' ?></a>
                </td>
                <td>
                  <a class="btn btn-xs btn-info" href="detail.php?id=<?php echo $item['OrderId'] ?>">Chi tiết</a>
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
                  <?php
                  if (isset($_GET["page"])) {
                      # code...
                    $p = $_GET["page"];
                  } else {
                    $p = 1;
                  }
                  ?>
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