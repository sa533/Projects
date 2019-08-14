<?php
session_start();
		$username = $_POST['UserName'];
		$password = $_POST['Password'];
		$dbc=mysqli_connect("localhost","root","","ipl");
		$username = stripcslashes($username);
		$password = stripcslashes($password);
		$username = mysqli_real_escape_string($dbc,$username);
		$password = mysqli_real_escape_string($dbc,$password);

			$result = mysqli_query($dbc,"select password,team_name from teams where team_name='$username';")
				or die('Failed to query database '.mysqli_error($dbc));
			
				$row= mysqli_fetch_array($result);
					if($row['team_name']== $username && $row['password']==$password)
					{
						$_SESSION['team_name']=$username;
							echo ("<script>
							window.location.href='rules.html';
							window.alert('$username Team  . .Loginned Successfully. .');
				     	    </script>");										
					}
					else
					{
						echo ("<script>
							window.alert('Login Unsuccessful. . . Try Again. . .');
							window.location.href='teamlogin.html';
					        </script>");
					}
		mysqli_close($dbc);
?>