
<?php 
$open = "review";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editreview = $db->fetchID("review",$id,"ReviewId");

if (empty($Editreview)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("review");
}
$num = $db->delete("review",$id,"ReviewId");
if ($num > 0) {
  # code...
  $_SESSION['success'] = "Xóa thành công";
  redirectAdmin("review");
}
else {
  $_SESSION['error'] = "Có lỗi khi xóa";
  redirectAdmin("review");
}
?>