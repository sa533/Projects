<?php
session_start();
if( !isset($_SESSION['team_name']) && !isset($_SESSION['username1']) )
header("location:index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Teams</title>
	<link rel="stylesheet" href="list_teams.css">
</head>
<body>
	<div class="box">
		<h2 class="heading">Team List</h2>
		</label><br><br><br>
<table border="2" class="tablestyle">
<th>Team ID</th>
<th>Team Name</th>
<th>Team Logo</th>
<tbody>
			<?php
			error_reporting(E_ERROR|E_PARSE);
			$dbc=mysqli_connect("localhost","root","","ipl");
			$sql="select * from list_teams";
			$result = mysqli_query($dbc,$sql);
				while( $row=mysqli_fetch_array($result))	
				{
					?><tr style="font-size:20px"><td align="center"><?php echo $row["team_id"];?></td>
					<td align="center"><?php echo $row["team_name"];?></td>
					<td align="center"><img src="<?php echo $row['image'];?>" width="50" height="50" ></td>
            <?php 	
				}	
		mysqli_close($dbc);
	?>
</tr>
</tbody>
</table>
</div>
</body>
</html>