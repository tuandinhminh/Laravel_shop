
<?php 
$open = "admin";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editadmin = $db->fetchID("admin",$id,"id");

if (empty($Editadmin)) {
  # code...
  $_SESSION['error'] = "Dữ liệu không tồn tại";
  redirectAdmin("admin");
}
$num = $db->delete("admin",$id,"id");
if ($num > 0) {
  # code...
  $_SESSION['success'] = "Xóa thành công";
  redirectAdmin("admin");
}
else {
  $_SESSION['error'] = "Có lỗi khi xóa";
  redirectAdmin("admin");
}
?>