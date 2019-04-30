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

<body>
	<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Reset password</h3>
				
				<div class="d-flex justify-content-end social_icon">
					</div>
			</div>
			<div class="card-body">
	<form method="post" action="">
		<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
	<input type="text" name="username" id="username" class="form-control" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1" required="" autofocus="">
					</div>
<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
		<input type="password" name="newpassword" id="email" class="form-control" placeholder="password" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2"  required="" autofocus="">
					</div>

					<br />
					<br />
	<input type="submit" name="submit" value="Confirm" class="btn btn-primary btn-block btn-lg" tabindex="5">
	<a class="btn btn-warning btn-block btn-lg" href="login.php"> Cancel

</form>


<?php
	require('classes/connection.php');
	
	$username=$_POST['username'];
	
	$password=password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
	if(isset($_POST['submit'])){

		$stmt=$db->prepare("UPDATE members set password='$password' where username = '$username'");
		$stmt->execute();
		echo '<script type="text/javascript">alert("Succesfull reset");</script>';
		 echo("<script>window.location = 'login.php';</script>");
	}


?>
