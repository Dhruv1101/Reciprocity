<?php

	session_start();

	$user='root';
	$pass='';
	$db='bookshare';

	$link=mysqli_connect('localhost',$user,$pass,$db);
	$error=null;

	if(mysqli_connect_error()){
		$error="There was an error connecting to DB!";
	}else{
		//SUCCESSFULLLY CONNECTED TO DB
		if(array_key_exists("name", $_POST) AND array_key_exists("email", $_POST) AND array_key_exists("password", $_POST) AND array_key_exists("cpassword", $_POST) AND array_key_exists("phone_number", $_POST) AND array_key_exists("gender", $_POST)){
			//user has eneter everything or blank page is submitted
			if($_POST['email']=="" OR $_POST['password']=="" OR $_POST['cpassword']=="" OR $_POST['name']=="" OR $_POST['phone_number']=="" OR $_POST['gender']==""){
				$error="Please enter all the fields!";
			}else if($_POST['password']!=$_POST['cpassword']){//TO CHECK IF PASSWORD AND CONFIRM PASSWORD MATCH
				$error="Your passwords should be same!";
			}else{
				//user has entered everthing
				$query="SELECT * FROM stuff WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";
				$result=mysqli_query($link,$query);//query to select users with the entered email

				if(mysqli_num_rows($result)>0){
					$error="Unfortunately Email is already taken!";//cant keep 2 or more same email ids
				}else{
					//EVERTHNG IS VALID, ADD THE USER INTO THE DATABASE
					$query="INSERT INTO stuff (name,email,password,phone_number,gender) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['password']."','".$_POST['phone_number']."','".$_POST['gender']."')";//*********SQL PROTECTION REQUIRED*******

					if(mysqli_query($link,$query)){
						// echo "<p>YOU HAVE BEEN SIGNED UP</p>";

						header("Location: login.php");
						
					}else{
						$error="There was a problem signing you up!";
					}
				}
			}
		}
	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Register | BrainTeasers</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="register.css"> -->

	<style type="text/css">
	    <?php 
	      include 'register.css';
	    ?>
  	</style>

</head>
<body>
<a href="index.html" class="previous round">&#8249;</a>
<form method="post">
	<div class="reg-box">

		<!-- FOR DISPLAYING ERRORS -->
		<?php
			if($error!=null){
				echo "<div id=\"error\"><p>".$error."</p></div>";
			}
		?>
	

		<h1>Register</h1>

		<div class="textbox">
			<input type="text" placeholder="Name" name="name" autocomplete="off"> 
		</div>

		<div class="textbox">
			<input type="Email" pattern=".+@ppsu.ac.in" placeholder="Email" name="email" autocomplete="off"> 
		</div>
		
	    <div class="textbox">
	    	<input type="password" placeholder="Password" name="password" autocomplete="off">  
		</div>
		
		<div class="textbox">
			<input type="password" placeholder="Confirm Password" name="cpassword" autocomplete="off">  
		</div>
		
		<div class="textbox">
			<input type="number" placeholder="Phone_Number" name="phone_number" autocomplete="off">  
		</div>


		
		<p class="Rbtn">
		Gender :
		<label>
			<input type="radio" name="gender" value="male" checked>  
			Male
		</label>

		<label>
			<input type="radio" name="gender" value="female">  
			Female
		</label>
		<p>
		
		<input class="btn" type="submit" value="Register">
	</div>
</form>


</body>
</html>