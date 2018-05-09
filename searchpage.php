 
<?php include "includes/header.php"; ?>
<?php include "Classes/Recipe.php"; ?>
<head>
        <link rel="stylesheet"
        href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<!--============ Navigation ============-->
<?php include "includes/navigation.php"; ?>
  
<?php 
    $NameKeywords = "";
    $NameError='';
    $CategoryErr = '';
	$MealErr = '';
    $IngredientError=''; 
	$Category_ID = 0;
    $Meal_type_ID = 0;
	$Checked  = 0;
	
	if(isset($_POST['submit'])){
	   $Checked = $_POST['search'];
		
		if ($Checked == 0 ) { 
            if(empty($_POST['NameKeyword'])){
		      $NameError = ' * Required ';
		  }
		}
		if ($Checked == 1 ) { 
			if(empty($_POST['Category'])){
                $CategoryErr= ' * Required';
            }
        }
        
		if ($Checked == 2 ) {	
			if(empty($_POST['MealType'])){
                $MealErr= ' * Required';
            }
        }
         		
    }        
?> 
 <script>
function updateSeachBy(){
	document.getElementById("searchBy").checked = true;
}
</script>    
   
      
 <form action="#" method="post" style= "Width:850px">
 <div class='form-group'>
  <!--Search By Name-->
  <input type="radio" name="search" id = "searchByName" value="0" <?php if($Checked == 0){echo "checked"; } ?>> Search By Name : 
  <input type="text" name="NameKeyword"  style="font-weight:bold;" >
  <big><font color=#CC0000><?php echo $NameError;?></font></big> 
  <br/><br/> 
  
  <!--Search By Category-->
  <input type="radio" name="search" id = "searchByCategory" value="1" <?php if($Checked == 1){echo "checked"; } ?>> Search By Category : 
  
   <select name='Category' style="font-weight:bold;font-size:13pt" onChange="updateSeachBy()">
   <div class="dropdown"><ul class="dropdown-menu">
   <option value = '0'>----</option></ul></div>
    <?php 
        
       for($i=1; $i<=4; $i++){
           $categoryName = RECIPE::GetCategoryName($i);
           echo "<option value=\"$i\" ";

           if($Category_ID == $i){echo "selected"; }
           echo ">$categoryName</option>";
        }
    ?>
</select><big><font color=#CC0000><?php echo $CategoryErr;?></font></big>
<br/><br/> 
    
    <!--Search By MealType-->
    <input type="radio" name="search" id = "searchByMealType" value="2" <?php if($Checked == 2){echo "checked"; } ?>> Search By Meal Type : 

    <select name='MealType' style="font-weight:bold;font-size:13pt" onChange="updateSeachBy()">
    <option value = '0'>----</option>
    <?php 
        for($i=1; $i<=4; $i++){
           $mealTypeName = RECIPE::GetMealTypeName($i);
           echo "<option value=\"$i\" ";
           if($Meal_type_ID == $i){echo "selected"; }
           echo ">$mealTypeName</option>";
           }
    ?>
    </select><big><font color=#CC0000><?php echo $MealErr;?></font></big>
    <br/><br/>
     
 <input class="btn btn-success btn-sm"type="submit" name="submit" value="Search Recipes">
</div>            
     <!--To Display Userid-->
</form> 
<br/><br/>
             
  
<?php  
    echo "<hr size='5' width='750'>";
        if(isset($_POST['submit'])){

            $Category_ID = $_POST['Category'];
            $Meal_type_ID = $_POST['MealType']; 
            $NameKeywords = $_POST['NameKeyword'];

            $RecipeArray = RECIPE::ReadAllRecipes();
 
            switch($Checked){ 
                case 0:
                    $RecipeArray = RECIPE::SearchByName($NameKeywords);
                    break;
                case 1:
                    $RecipeArray = RECIPE::SearchByCategory($Category_ID);
                    break;
                case 2:                        
                    $RecipeArray = RECIPE::SearchByMealType($Meal_type_ID);
                    break; 
                    
            
            }
                RECIPE::Display( $RecipeArray ) ;
        }
?>		                          
    
      
     
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