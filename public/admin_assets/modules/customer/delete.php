
<?php 
$open = "customer";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editcustomer = $db->fetchID("customer",$id,"CustomerId");

if (empty($Editcustomer)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("customer");
}
$num = $db->delete("customer",$id,"CustomerId");
if ($num > 0) {
  # code...
  $_SESSION['success'] = "Xóa thành công";
  redirectAdmin("customer");
}
else {
  $_SESSION['error'] = "Có lỗi khi xóa";
  redirectAdmin("customer");
}
?>