<?php 
    ob_start(); 
	if(! isset($_SESSION)){
		session_start();
	}
?>
<?php include "Classes/Recipe.php"; ?>
<?php include "includes/header.php"; ?>
<head>
    <style>
        td{
            width:auto:;
        }
    </style>
</head>
<body>

<!--============ Navigation ============-->
<?php include "includes/navSearch.php";?>
     
<?php 
	if( isset($_GET['recipe_name']) AND isset($_GET['Picture']) AND isset($_GET['Servings']) AND isset($_GET['cooking_time'])){
        $ingredients = Recipe::ReadAllIngredients($_GET['recipe_id']);
        $steps = Recipe::ReadPreparationSteps($_GET['recipe_id']);
        
        echo "<table border=1>";
        echo "<th > Recipe Picture </th>";
        echo "<th > Recipe Description </th>"; 
        echo "<th> Recipe Ingredients </th>";
        echo "<th> Recipe Preparation Steps </th>";
        echo "<tr>"; 
        
        echo "<td>";
        echo "<img src = \"images/recipe/".$_GET['Picture']." \" height='auto' width='250px' />";
        echo "</td>";
        
       
        echo "<td>";
        echo "<i><b>Recipe Name:-</i></b> ".$_GET['recipe_name']."<br/>";
        echo "<i><b>Servings:-</i></b> ".$_GET['Servings']."<br/>";
        echo "<i><b>Cooking Time:-</i></b> ".$_GET['cooking_time']."<br/>";
        echo "</td>";

        echo "<td >";
        foreach($ingredients as $Index => $Element){   
        echo $Element['ingredient_name'].': ' .$Element['Quantity'].'<br/>';  }
        echo "</td>";
        
        echo "<td style='padding-Right: 25px;'>";
         echo "<table >";
         foreach($steps as $Index => $Element){
             echo "<tr>";
                echo "<p style='color:Black; text-align:left';>";
                echo $Element['steps']. "). " . $Element['recipe_description'];
                echo "</p>";
             echo "</tr>";
            }
          echo "</table>";
          echo "</td>";
        
        echo "</tr>";
        echo "</table>";
    }
?>
<?php
    if(isset($_POST['submit_Favorite']) and isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $recipe_id = $_GET['recipe_id'];
        $Rating = $_POST['Rating'];
        Recipe::AddToList($user_id,$recipe_id,$Rating);
        echo "<br/><br/>";
       
    }
      ?>
    <form action="#" method="post" align="right">
	<div class="form-group">
       <input type = 'hidden' name = 'recipe_id' value="<?php echo $_GET['recipe_id'] ?>">
       <input type = 'hidden' name = 'user_id' value="<?php echo $_SESSION['user_id'] ?>">
       
        <select name='Rating' style="font-weight:bold;font-size:13pt">
           <option value ="1"> * </option>
           <option value ="2"> ** </option>
           <option value ="3"> ***</option>
           <option value ="4"> ****</option>
           <option value ="5"> *****</option>
                    
        </select>
       <br/><br/> 
       <input type = 'submit' name = 'submit_Favorite' value = 'AddToFavouriteList&Rating' class="btn btn-success btn-sm">
        <br/><br/> 
    </div> 
    </form>








