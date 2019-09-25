<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";
$menu = $db->fetchAll("menu");
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="container-fluid">


  <!-- Page Content -->
  <h1>Danh sách menu
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

  <div class="table-responsive">
    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
      
      <div class="row">
        <div class="col-sm-12">
          <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
              <tr role="row">
                <th >STT</th>
                <th >MenuName</th>
                
                <th>Home</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $stt =1 ;foreach ($menu as $item): ?>
              <tr role="row" class="odd">
                <td class="sorting_1"><?php echo $stt; ?></td>
                <td><?php echo $item['MenuName'] ?></td>
                
                <td>
                  <a href="home.php?id=<?php echo $item['MenuId'] ?>" class="btn btn-<?php echo $item['home'] == 0 ? 'default' : 'info' ?>">
                    <?php echo $item['home'] == 1 ? 'Hiển thị' : 'Không' ?></a>
                  </td>
                  
                  <td>
                    <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['MenuId'] ?>">Sửa</a>
                    <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['MenuId'] ?>">Xóa</a>
                  </td>

                </tr>
                <?php $stt++; endforeach ?>
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

  <?php require_once __DIR__. "/../../layouts/footer.php"; ?>