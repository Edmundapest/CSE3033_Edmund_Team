<?php require('include/connection.php');
//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: home.php'); exit(); }
//if form has been submitted process it
if(isset($_POST['submit'])){
    if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";
	$username = $_POST['username'];
	//very basic validation
	if(!$user->isValidUsername($username)){
		$error[] = 'Usernames must be at least 3 Alphanumeric characters without symbols';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $username));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}
	}
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}
	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}
	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}
	//email validation
	$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
	}
	//if no errors have been created carry on
	if(!isset($error)){
		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
		try {
			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $username,
				':password' => $hashedpassword,
				':email' => $email,
				':active' => 'Yes'
			));
			$id = $db->lastInsertId('memberID');
			//send email
			$subject = "Registration Confirmation";
			$body = "<p>Thank you for registering at demo site.</p>";
			//redirect to index page
			header('Location: index.php?action=joined');
			exit;
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}
//define page title
$title = 'Demo';
//include header template

?>
<!DOCTYPE html>
<html>
<head>
<style>
	p {
		color:white;
}
</style>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




</head>
<body>

	<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
				<p color="blue">Already a member? <a href='login.php'>Login</a></p>
				<hr>
				<div class="d-flex justify-content-end social_icon">
					
				</div>
			</div>
	   		<div class="card-body">
			<form role="form" method="post" action="" autocomplete="off">
			
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){

						echo '<script type="text/javascript">alert("'.$error.'");</script>';

						
					}
				}
				//if action is joined show sucess
				else if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo '<script type="text/javascript">alert("Registration successful");</script>';
					header('Location: login.php');
				}
				?>
			

				
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
					<input type="text" name="username" id="username" class="form-control" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1" required="" autofocus="">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
					<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2"  required="" autofocus="">
					</div>
						
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>	
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" tabindex="3"  required="" autofocus="">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" placeholder="Confirm Password" tabindex="4"  required="" autofocus="">
					</div>
					<input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5">
				
			</form>
		</div>
	</div>

</div>

