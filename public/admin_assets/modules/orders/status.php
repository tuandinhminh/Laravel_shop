<?php 
require_once __DIR__. "/../../autoload/autoload.php";

$id = intval(getInput('id'));
$Edittran = $db->fetchID("orders",$id,"OrderId");

if (empty($Edittran)) {
			# code...
	$_SESSION['error'] = "dữ liệu không tồn tại!";
	redirectAdmin("orders");
}

if ($Edittran['Status'] == 0) {
			# code...
	$Status = $Edittran['Status'] == 0 ? 1 : 0;
	$update = $db->update("orders",array("Status" => $Status),array("OrderId" => $id));


	if ($update > 0) {
			# code...
		$_SESSION['success'] = 'cap nhat thanh cong';
		$sql = "SELECT ProductId,Quantity FROM detailproductorder WHERE OrderId = $id ";
		$Order = $db->fetchsql($sql);
		foreach ($Order as $item) {
				# code...
			$idproduct = intval($item['ProductId']);
			$product = $db->fetchID("product",$idproduct,"ProductId");

			$sold = $product['Sold']+1;
			$update1 = $db->update("product",array("Sold" => $sold),array("ProductId" => $idproduct));

		}
		redirectAdmin('orders');
	} else {
		$_SESSION['error'] = 'cap nhat that bai';
		redirectAdmin('orders');
	}
}

if ($Edittran['Status'] == 1) {
			# code...
	$Status = $Edittran['Status'] == 0 ? 1 : 0;
	$update = $db->update("orders",array("Status" => $Status),array("OrderId" => $id));


	if ($update > 0) {
			# code...
		$_SESSION['success'] = 'cap nhat thanh cong';
		$sql = "SELECT ProductId FROM detailproductorder WHERE OrderId = $id ";
		$Order = $db->fetchsql($sql);
		foreach ($Order as $item) {
				# code...
			$idproduct = intval($item['ProductId']);
			$product = $db->fetchID("product",$idproduct,"ProductId");
			$sold = $product['Sold'] - 1;
			$update1 = $db->update("product",array("Sold" => $sold),array("ProductId" => $idproduct));

		}
		redirectAdmin('orders');
	} else {
		$_SESSION['error'] = 'cap nhat that bai';
		redirectAdmin('orders');
	}
}



?>