
<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput("id"));

$Editmenu = $db->fetchID("menu",$id,"MenuId");

if (empty($Editmenu)) {
  # code...
	$_SESSION['error'] = "Dữ liệu không tồn tại";
	redirectAdmin("menu");
}
$is_product = $db->fetchOne("product"," MenuId = $id ");
if ($is_product == NULL) {
	# code...
	$num = $db->delete("menu",$id,"MenuId");
	if ($num > 0) {
  # code...
		$_SESSION['success'] = "Xóa thành công";
		redirectAdmin("menu");
	}
	else {
		$_SESSION['error'] = "Có lỗi khi xóa";
		redirectAdmin("menu");
	}
} else {
	$_SESSION['error'] = "Danh mục có sản phẩm bạn không thể xóa";
	redirectAdmin("menu");
}

?>