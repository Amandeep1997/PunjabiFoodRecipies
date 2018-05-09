<?php require_once "ClassDatabase.php";
class USER{
	
	private $username; 
    private $email; 
    private $password; 
    private $user_id;
    private $salt;
	private static $database;
	
	function __construct($username , $password, $email, $salt = null, $user_id = null)
    {
        $this->username = $username;
        $this->email = $email; 
        $this->password = $password;
        $this->salt = $salt;
        $this->user_id = $user_id;
	}
	public static function Init_Database(){
		if(! isset(self::$database)){
			self::$database = new Database();
		}
	}  
	public function Create(){
        
        $this->salt = self::Create_Salt($this->password);
        $this->password = self::Encrypt($this->password);
        self::Init_Database();
		$query = "INSERT INTO user(username , email, password , salt ) ";
		$query .= "VALUES(?,?,?,?)";
		
		try{
			$sql = self::$database->Connection->prepare($query);
            $sql->bindParam(1, $this->username);
            $sql->bindParam(2, $this->email);               
            $sql->bindParam(3, $this->password);
            $sql->bindParam(4, $this->salt); 
             
			$sql->execute();
			$last_id = self::$database->Connection->LastInsertId();
			return $last_id;
			
		}catch(PDOException $e){
			echo "Query INSERT Failed ".$e->getMessage();
		}
	}
    public static function Login($username, $password){
       $encrypted_password = self::Encrypt($password);
		$query  = "SELECT * FROM user ";
        $query .= "WHERE username = '$username' AND password = '$encrypted_password'";
        
		self::Init_Database();
		try{
			$sql = self::$database->Connection->prepare($query);
			$sql->execute();
			$result = $sql->fetch(PDO::FETCH_OBJ);
			
            
			return !empty($result->user_id);
			
		}catch(PDOException $e){
			echo "Query SELECT Failed ".$e->getMessage();
		}
	}
    public static function Email_Exists($username , $email){
		self::init_database();
		$connection = self::$database->GetConnection();
		
		try{
			$query = "SELECT user_id FROM USER ";
			$query .= "WHERE username = '$username' AND email = '$email'";
			
			$stmt = $connection->prepare($query);
			$stmt->execute();
			$userObj = $stmt->fetch(PDO::FETCH_OBJ);
			
			return !empty($userObj->ID);
		}catch(PDOException $e){
			echo "Query Failed ".$e->getMessage();
		}
	}
	public static function Username_Exists($username){
		$query = "SELECT user_id FROM user WHERE username = '$username' ";
		self::Init_Database();
		try{
			$sql = self::$database->Connection->prepare($query);
			$sql->execute(); 
			$result = $sql->fetch(PDO::FETCH_OBJ);
			
			return !empty($result->user_id);
		}
        catch(PDOException $e){
			echo "Query SELECT Failed ".$e->getMessage();
		}
	}
    public static function Get_User_ID($username){
		$query = "SELECT user_id FROM user WHERE username = '$username' ";
		self::Init_Database();
		try{
			$sql = self::$database->Connection->prepare($query);
			$sql->execute(); 
			$result = $sql->fetch(PDO::FETCH_OBJ);
			
			return $result->user_id;
		}
        catch(PDOException $e){
			echo "Query SELECT Failed ".$e->getMessage();
		}
	}
    public static function Create_Salt($password){
        $random = MD5($password);
        $salt = Substr($random,0,22);
        $hash = '$2y$10$';
        return $hash.$salt;
    }
    
    public static function Encrypt($password){
        $salt =  self::Create_Salt($password);
        $encryptedPassword = crypt($password, $salt);
        //echo "Salt: ".$salt."<br>";
        //echo "Password: ".$encryptedPassword ;
        return $encryptedPassword;
    }
    /*Favourite List of the user*/
    public static function MyFavoriteList($user_id){
		
		self::init_database();
		$connection = self::$database->GetConnection();
		$query  = "SELECT r.* FROM recipe r, fav_user_recipe fur WHERE r.recipe_id = fur.recipe_id AND fur.user_id =  $user_id "; 
		try{
			$stmt = $connection->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e)
		{
			echo "Query Failed: ".$e->getMessage();
		}
		
	}
    public static function Update_password($username, $new_password){
        self::init_database();
        $connection = self::$database->GetConnection(); 
        $salt = self::Create_Salt($new_password);
        $new_encrypted = crypt($new_password, $salt);
        try{
            $connection->beginTransaction();
            $query = "Update User Set Password = '$new_encrypted' Where Username='$username' ";
            $query = "Update User Set Salt = '$salt' Where Username='$username' ";
            $connection->commit();
        }
        catch(PDOException $e){
            echo "Query Failed ".$e->getMessage();
            $connection->rollback();
        }
    }
}
?>