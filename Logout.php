<?php 
ob_start();

if(isset($_SESSION)){ 
	$_SESSION['user_id'] = null;
}
header("Location:../PunjabiFoodRecipies");
?>