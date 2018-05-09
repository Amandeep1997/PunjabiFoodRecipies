<?php 
    ob_start(); 
	if(! isset($_SESSION)){
		session_start();
	}
?>
<?php include "includes/header.php"; ?>
<?php include "Classes/ClassUser.php"; ?>
<body>
<!--============ Navigation ============-->
<?php include "includes/navigation.php"; ?>

<!--============ Login Form ============-->
<div class="cotn_principal">
<div class="cont_centrar">

<div class="cont_login">
<div class="cont_info_log_sign_up">
<div class="col_md_login">
<div class="cont_ba_opcitiy">
        
  <h2>LOGIN</h2>  
  <p>Please Enter your information in order to Login.</p> 
  <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
  </div>
  </div>
  <div class="col_md_sign_up">
  <div class="cont_ba_opcitiy">
  <h2>SIGN UP</h2>

  
  <p>Please Complete your information in order to Sign Up.</p>

  <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
  </div>
  </div>
  </div>

  <div class="cont_back_info">
  <div class="cont_img_back_grey">
  <img src=images/food.jpg /></div> 
  </div>
  
<!-- My Php Code for login and sign up form  -->  
 <!-- for Register -->
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
 <!-- For login -->
<?php
    $login_error = '';
    $login_confirm = '';
    if(! isset($_SESSION)){
        session_start();
    }
    
    if(isset($_POST['login']) &&!empty ($_POST['usernameLogin']) && !empty($_POST['passwordLogin']))
    {
        $usernameLogin = $_POST['usernameLogin'];
        $passwordLogin = $_POST['passwordLogin'];
        //echo "Login ".user::Login($usernameLogin, $passwordLogin);
        
        if(user::Login($usernameLogin, $passwordLogin))
        {
            $login_confirm = '<div class="alert alert-success" role="alert"><br/><strong>   Your Login is Successfull ! </strong></div><br/>';
            $_SESSION['user_id'] = USER::Get_User_ID($usernameLogin);
            Header ("Location:searchpage.php"); 
           }
         else{
             $login_error = '<div class="alert alert-danger" role="alert"> <strong>   Error : UserName and Password combination is incorrect !</strong> </div><br/>';
        }
    }
?>		
 
   <br/><br/>
        
    <?php echo $login_error; ?>
    <font color=#006600><?php echo $login_confirm; ?></font> 
    <br/><br/>	
    
    <form action="#" method="post">     
    <div class="cont_forms" >
        <div class="cont_img_back_">
           <img src="images/food.jpg" alt="" />
         </div>
         <div class="cont_form_login">
         <a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
         <h2>LOGIN</h2>
         <input type="text" placeholder="User name" name="usernameLogin" />
         <input type="password" placeholder="Password" name="passwordLogin"/>
         <button class="btn_login" name="login" onclick="cambiar_login()">LOGIN</button>
         <br/><br/> 
         <a  href="resetPassword.php"> Reset Password</a>
         </div>

         <div class="cont_form_sign_up">
         <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
         <h2>SIGN UP</h2>
         <input type="text" placeholder="User Name" name = "Username"/>
         <input type="password" placeholder="Password" name="Password" />
         <input type="email" placeholder="Email" name ="Email"/>
         
         <button class="btn_sign_up" name="Register" onclick="cambiar_sign_up()">SIGN UP</button>
         
        </div>
        </div>
    </form>
     
  </div>
 </div>
</div>
  
  

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