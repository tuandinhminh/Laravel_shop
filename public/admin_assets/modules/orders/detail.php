<?php 
$open = "orders";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput('id'));


$sql = "SELECT detailproductorder.*,product.* FROM detailproductorder left join product on detailproductorder.ProductId = product.ProductId WHERE OrderId = $id ORDER BY OrderId DESC";
$order = $db->fetchsql($sql);
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
                <th>product name</th>        
                <th >Product_id</th>
                <th>Quantity</th>
                <th>Price</th>
                

              </tr>
            </thead>
            <tbody>
              <?php $stt =1 ;foreach ($order as $item): ?>

                <tr role="row" class="odd">
                  <td class="sorting_1"><?php echo $stt; ?></td>
                  <td><?php echo $item['ProductName'] ?></td>
                  <td><?php echo $item['ProductId'] ?></td>
                  <td><?php echo $item['Quantity'] ?></td>
                  <td><?php echo $item['Price'] ?></td>


                </tr>
              
              
              <?php $stt++; endforeach ?>

            </tbody>
          </table>
                  

        </div>
      </div>
      
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>