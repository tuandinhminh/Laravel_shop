
<?php 
$open = "discount";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editdiscount = $db->fetchID("discount",$id,"DiscountId");

if (empty($Editdiscount)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("discount");
}
$num = $db->delete("discount",$id,"DiscountId");
if ($num > 0) {
  # code...
  $_SESSION['success'] = "Xóa thành công";
  redirectAdmin("discount");
}
else {
  $_SESSION['error'] = "Có lỗi khi xóa";
  redirectAdmin("discount");
}
?>