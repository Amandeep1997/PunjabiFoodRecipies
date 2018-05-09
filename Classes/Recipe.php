<head>
<link rel="stylesheet"
href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
table{
  border:1px solid black;
  margin:0px auto; 
  width:350px;
}   
</style>
</head>
<?php
require_once "ClassDatabase.php";

class Recipe{
    
    private static $database;
    
    private static function init_database(){
        if(!isset(self::$database)){
			self::$database = new Database();
    } 
}
public static function ReadAllRecipes(){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT * FROM recipe  ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Read Recipes Failed: ".$e->getMessage();
		}
		
	}
    
    public static function ReadAllIngredients($recipe_id){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT ri.Quantity, i.ingredient_name FROM ingredients i , recipe_ingredient ri WHERE ri.ingredient_id = i.ingredient_id AND ri.recipe_id = $recipe_id ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Read ingredients Failed: ".$e->getMessage();
		}
		
	}
    public static function ReadPreparationSteps($recipe_id){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT * FROM recipe_preparation WHERE recipe_id = $recipe_id ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Read Preparation Steps Failed: ".$e->getMessage();
		}
		
	}
    
    public static function ReadMealType($meal_id){
        	
        self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT Description FROM meal_type WHERE meal_id = $meal_id ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Read meal type Failed: ".$e->getMessage();
		}
    }
    
    public static function ReadCategory($recipe_id){
        	
        self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT Name FROM category c, recipe r WHERE r.recipe_id = $recipe_id AND c.CategoryId = r.category_id ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Read Category Failed: ".$e->getMessage();
		}
    }
    
    public static function AddToList($user_id,$recipe_id,$Rating){
        	
        self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "Insert into fav_user_recipe(user_id, recipe_id,Rating) ";
		$query .= "Values(?,?,?);";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->bindParam(1,$user_id);
			$stmt->bindParam(2,$recipe_id); 
			$stmt->bindParam(3,$Rating); 
            $stmt->execute(); 
			return true;
			
		}catch(PDOException $e){
			echo "Query Failed ".  $e->getMessage();
		}
        return false;
    } 
    
    public static function Display($array){
        
    echo "<table border='1'>";
        
        echo "<th style='color:Red'>Recipe</th>";
        echo "<th style='color:Red'>Recipe Name</th>";
        echo "<th style='color:Red'>Ingredients</th>";
        echo "<th style='color:Red'>Preparation </th>";
         
        
	foreach($array as $Index => $Element){
           
        $ingredients = self::ReadAllIngredients($Element['recipe_id']);
        $steps = self::ReadPreparationSteps($Element['recipe_id']);
         
		echo "<tr>";
        echo "<td>";
        echo "<a href='SingleRecipeDetail.php?recipe_id=".$Element['recipe_id']."&recipe_name=".$Element['recipe_name']."&Picture=".$Element['Picture']."&Servings=".$Element['Servings']."&cooking_time=".$Element['cooking_time']. " '>";

        echo "<img src = \"images/recipe/".$Element['Picture']." \" height='auto' width='250px' />";
        echo "</td>";
        
        echo "<td>";
        echo "<table >";
        echo "<tr>";
        echo "<p style='color:Black; text-align:left';>";
        echo "<i><b>Recipe Name:-</i></b> ".$Element['recipe_name']."<br/>";
        echo "<i><b>Servings:-</i></b> ".$Element['Servings']."<br/>";
        echo "<i><b>Cooking Time:-</i></b> ".$Element['cooking_time']."<br/>";
        echo "</td>";
        echo "</table >";
        
        echo "<td>";
        echo "<table >";
        foreach($ingredients as $Index => $Element){ 
            echo "<tr>";
            echo "<p style='color:Black; text-align:left';>";
            echo $Element['ingredient_name'].': ' .$Element['Quantity'].'<br/>'; 
            echo "</p>"; 
            echo "</tr>";
        }
        echo "</td>";
        echo "</table >";
        
        echo "<td>";
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
        
        //end of main table
         				
    }
     echo "</tr>";
    echo "</table>";echo "<br/>";echo "<br/>";
        
}
//Drop down for category
 public static function GetCategoryName($category_id) {
	  
    self::Init_Database(); 
    $connection = self::$database->GetConnection();
		try{
            $query = "SELECT * FROM category WHERE  CategoryId  = '$category_id'";
			$stmt = $connection->prepare($query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result->Name;
			
		}catch(PDOException $e){
			echo "Query Failed ".$e->getMessage();
		}
        
}
//Drop down for MealType    
 public static function GetMealTypeName($MealType_id) {
	 
    self::Init_Database();
    $connection = self::$database->GetConnection();
    
    try{
        $query = "SELECT * FROM  meal_type  WHERE  meal_id = '$MealType_id'";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->Description;

    }catch(PDOException $e){
        echo "Query Failed ".$e->getMessage();
    }
}    
    
//-----------Search---------//
    //-------ByName------//
public static function SearchByName($SearchName){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT * FROM recipe WHERE recipe_name LIKE '%$SearchName%'  ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Search Recipes Failed: ".$e->getMessage();
		}
		
	}
    
//----------ByCategory--------//
    
public static function SearchByCategory($Category_ID){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT recipe.* FROM recipe ,category WHERE recipe.category_id = category.CategoryId AND recipe.category_id = $Category_ID ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Search Recipes Failed: ".$e->getMessage();
		}
		
	} 
 //---------By Meal Type-----------//   
 public static function SearchByMealType($Meal_type_ID){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT r.* FROM recipe r, meal_type m WHERE r.meal_id = m.meal_id AND r.meal_id = $Meal_type_ID ";
		
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query search Recipes Failed: ".$e->getMessage();
		}
		
   }
      
}
?>












