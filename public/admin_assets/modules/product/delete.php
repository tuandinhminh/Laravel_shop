
<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editproduct = $db->fetchID("product",$id,"ProductId");

if (empty($Editproduct)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("product");
}
$num = $db->delete("product",$id,"ProductId");
if ($num > 0) {
  # code...
  $_SESSION['success'] = "Xóa thành công";
  redirectAdmin("product");
}
else {
  $_SESSION['error'] = "Có lỗi khi xóa";
  redirectAdmin("product");
}
?>