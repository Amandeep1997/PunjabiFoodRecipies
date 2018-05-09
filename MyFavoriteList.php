<?php
ob_start();
if(! isset($_SESSION))
 {
   session_start();
 }
?>
<?php include "classes/ClassUser.php"; ?>
<?php include "classes/Recipe.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navSearch.php";?>
 
<div class="container">
        <?php 
         Recipe::Display( User::MyFavoriteList($_SESSION['user_id']) ) ;
        ?>
    
</div>