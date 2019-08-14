<?php
session_start();

if( !isset($_SESSION['team_name']) && !isset($_SESSION['username1']) )
header("location:index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Unsold Player</title>
	<link rel="stylesheet" href="unsold_player.css">
</head>
<body>
	<div class="box">
		<h2 class="heading">Unsold Player</h2>
		</label><br><br><br>
<table border="2" class="tablestyle">
<thead style="color:white; font-size:20px">
<th>Role</th>
<th>Player ID</th>
<th style="width: 200px;text-align:center">Name</th>
<th>Base Price</th>
<th>Points</th>
<tbody>
			<?php
			error_reporting(E_ERROR|E_PARSE);
			$page = $_SERVER['PHP_SELF'];
 			$sec = "10";
 			header("Refresh: $sec; url=$page");
			$dbc=mysqli_connect("localhost","root","","ipl");
			$sql="select * from unsold_players";
			
			$result = mysqli_query($dbc,$sql);
				while( $row=mysqli_fetch_array($result))	
				{
					?> <tr style="font-size:20px"><td align="center" ><?php echo $row["role"];?></td>
					<td align="center"><?php echo $row["player_id"];?></td>
					<td align="center"><?php echo $row["player_name"];?></td>
					<td align="center"><?php echo $row["base_price"];?></td>
					<td align="center"><?php echo $row["points"];?></td>
				<?php 
				}	
		mysqli_close($dbc);
	?>
</tbody>
</table>	
</div>
</body>
</html>