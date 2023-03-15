<?php
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Database connection
	$conn = new mysqli('localhost','root','','tests');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {

		if(!empty($email) &&!empty($password))
		{
			//read from database
			$query = "select * from registration where email = '$email' limit 1";
			$result = mysqli_query($conn, $query);
			
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
						header("Location: main.html");
						die;
					}
				}
			}
			echo "wrong username or password!";
		}
		else{
			echo "Wrong username or password!";
			header('Location:login.html');
		}
		
		header('Location:login.html');
		exit();
		
	}
?>