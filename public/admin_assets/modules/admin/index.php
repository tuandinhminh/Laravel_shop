<?php 
$open = "admin";
require_once __DIR__. "/../../autoload/autoload.php";

$p = isset($_GET['page']) ? $_GET['page'] : 1;


$sql = "SELECT admin.* FROM admin ORDER BY id DESC";
$admin = $db->fetchJone("id","admin",$sql,$p,3,true);
if (isset($admin['page'])) {
  # code...
  $sotrang = $admin['page'];
  unset($admin['page']);
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">


  <!-- Page Content -->
  <h1>Danh sách admin 
    <a href="add.php" class="btn btn-success">Thêm mới</a>
  </h1>

  <div class="clearfix"></div>
  <!-- in thong bao -->
  

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
                <th>Email</th>
                <th >Action</th>

              </tr>
            </thead>
            <tbody>
              <?php $stt =1 ;foreach ($admin as $item): ?>
              <tr role="row" class="odd">
                <td class="sorting_1"><?php echo $stt; ?></td>
                <td><?php echo $item['AdminName'] ?></td>
                <td><?php echo $item['Email'] ?></td>
                <td>
                  <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>">Sửa</a>
                  <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>">Xóa</a>
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