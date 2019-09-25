<?php 
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput('id'));
$Edittran = $db->fetchID("review",$id,"ReviewId");

if (empty($Edittran)) {
			# code...
	$_SESSION['error'] = "dữ liệu không tồn tại!";
	redirectAdmin("orders");
}

			# code...
	$Status = $Edittran['Status'] == 0 ? 1 : 0;
	$update = $db->update("review",array("Status" => $Status),array("ReviewId" => $id));
	if ($update) {
		# code...
		$_SESSION['success'] = "cập nhật thành công";
		redirectAdmin('review');
	}
	


?>