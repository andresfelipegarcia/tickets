<?php

	session_start();

	if (isset($_POST['token']) && $_POST['token']!=='') {
			
	//Contiene las variables de configuracion para conectar a la base de datos
	include "../config/config.php";

	$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
	$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

    $query = mysqli_query($con,"SELECT * FROM user WHERE email =\"$email\" OR username=\"$email\" AND password = \"$password\";");

		if ($row = mysqli_fetch_array($query)) {
			$role = $row['role']; 
			echo "<script language='javascript'> alert('$role'); </script>"; 
			if($role == 'admin'){
				session_start();
				$_SESSION['user_id'] = $row['id'];
				$id = $_SESSION['user_id'];
				header("location: ../dashboard.php");
			}
			if ($role == 'user') {
					session_start();
					$_SESSION['user_id'] = $row['id'];
					$id = $_SESSION['user_id'];
					header("location: ../dashboard_users.php");
				}	

		}else{
			$invalid=sha1(md5("contrasena y email invalido"));
			header("location: ../index.php?invalid=$invalid");
		}
	}else{
		header("location: ../");
	}

?>