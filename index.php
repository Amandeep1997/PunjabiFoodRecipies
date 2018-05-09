<?php include "includes/header.php"; ?>
<?php include "Classes/Recipe.php"; ?>
<body>

<!--============ Navigation ============-->
<?php include "includes/navigation.php"; ?>
      
<!--============ Slider ============-->
<?php include "includes/slider.php"; ?>

<!--============ Best Dishes ============-->
<?php include "includes/bestdisheswrapper.php"; ?>
 
 
      
     
<script type="text/javascript">
    $('.sliderwrapper .slider').glide({
		autoplay: 7000,
		animationDuration: 3000,
		arrows: true,
		 
		});
	
</script>
	
    <script type="text/javascript">
    $('.bestdisheswrapper .slider').glide({
		autoplay: false,
		animationDuration: 700,
		arrows: true,
		navigation:false,
		 
		}); 
</script>
	
   
   

</body>