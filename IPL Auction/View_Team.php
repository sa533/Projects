<?php
session_start();

if( !isset($_SESSION['team_name']) && !isset($_SESSION['username1']) )
header("location:index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Team</title>
	<link rel="stylesheet" href="View_Team.css">

</head>
<body>
	<header>
		<img src="avatar.jpg">
	</header>
	<div class="background">	
	<div class="box">
	<form name="view_team" action="View_Team.php"  method="POST">
		<h2 class="heading">View Team</h2>
		</label><br>
		<center><label style="text-align:center; font-size:20px;">Team Name:</label>
		<input type="text" class="other" name="teamname" placeholder="Enter Team Name"><br>
		<input type="submit" class="loginbtn" name="view_team" value="View Team"></center>
		<br>
<table border="2" class="tablestyle">
<th>Role</th>
<th>Player ID</th>
<th>Name</th>
<th>Bid Price</th>	
<th>Points</th>
</div>
</div>
</form>
<tbody>
<?php 
	
	$dbc=mysqli_connect("localhost","root","","ipl");	
	error_reporting(E_ERROR|E_PARSE);
	$Team_name =$_POST['teamname'];
	$sea_team= "select * from view_team where team_name='$Team_name'";
	$result = mysqli_query($dbc,$sea_team);
	while($row=mysqli_fetch_array($result))	
	{
			?><tr><td align="center"><?php echo $row["role"];?></td>
			<td align="center"><?php echo $row["player_id"];?></td>
			<td align="center"><?php echo $row["player_name"];?></td>
			<td align="center"><?php echo $row["bid_price"];?></td>
			<td align="center"><?php echo $row["points"];?></td>
			<?php 
		}	
		mysqli_close($dbc);
	?>
	</tr>
	</tbody>
	</table>
</body>
</html>