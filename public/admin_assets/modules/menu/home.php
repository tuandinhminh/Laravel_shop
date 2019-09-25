<?php 
$open = "menu";
require_once __DIR__. "/../../autoload/autoload.php";
$id = intval(getInput('id'));
$Editmenu = $db->fetchID('menu',$id,"MenuId");
if (empty($Editmenu)) {
		# code...
	$_SESSION['error'] = "Du lieu khong ton tai";
	redirectAdmin('menu');
}
$home = $Editmenu['home'] == 0 ? 1 : 0;
$update = $db->update("menu",array("home" => $home),array("MenuId" => $id));
if ($update > 0) {
		# code...
	$_SESSION['success'] = 'cap nhat thanh cong';
	redirectAdmin('menu');
} else {
	$_SESSION['error'] = 'cap nhat that bai';
	redirectAdmin('menu');
}
?>