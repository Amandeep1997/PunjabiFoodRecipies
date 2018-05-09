<?php 
    ob_start(); 
	if(! isset($_SESSION)){
		session_start();
	}
?><head>
        <link rel="stylesheet"
        href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<?php include "includes/header.php"; ?>
<?php include "Classes/ClassUser.php"; ?>
<body>
<!--============ Navigation ============-->
<?php include "includes/navigation.php"; ?>

 
<!-- My Php Code for login and sign up form  -->  
  
<?php 
    
    if(isset($_POST['Register']) && !empty($_POST['Username'])
	    && !empty($_POST['Password']))
        {
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $email = $_POST['Email'];
             
         if(!USER::Username_Exists($username)){ 
            $newUser = new USER($username , $password, $email);
			$newUser->Create(); 
            }
            else{
                echo "Username already exists. Try again";
             }
        }
      
?>
   
 
   <br/><br/>
        
     
    
    <form action="#" method="post">     
          
         <?php
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                
                if(User::Username_Exists($username) ){
                    if($new_password === $confirm_password){
                        User::Update_password($username, $new_password);
                    }
                     else{
                         echo "New Password Mismatch Confirm Password";
                     }
                } 
                else{
                    echo "Old Password is correct";
                }
            }
        ?>

         <div class="col-sm-6" >
            <form action = '#' method = 'post'>
                <div class="form-group" align="center">
                <label for = 'username' style= 'float:left'>Username</label>
                <input type = 'text' name='username' class = 'form-control' required><br/>
                <label for = 'password' style= 'float:left'>Old Password</label>
                <input type = 'password' name='old_password' class = 'form-control' required><br/>
                <label for = 'new_password' style= 'float:left'>New Password</label>
                <input type = 'password' name='new_password' class = 'form-control' required><br/>
                <label for = 'confirm_password' style= 'float:left'>Confirm Password</label>
                <input type = 'password' name='confirm_password' class = 'form-control' required><br/>

                <input class = 'btn btn-danger' type = 'submit' name="submit" value = 'ChangePassword'>
                </div>
            </form>
					
				</div>
				
				<div class="bodytext" style="padding:12px;" align="justify">
					
      
     
   
   
    <script  src="js/index.js"></script>
</body>
      





             
              
              
            
    
      
     
    
    
 


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

</html>