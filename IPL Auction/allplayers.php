<?php
session_start();
if( !isset($_SESSION['team_name']) && !isset($_SESSION['username1']) )
header("location:index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Players</title>
	<link rel="stylesheet" type="text/css" href="allplayers.css">
</head>
<body class="b">
	<div class="box">
		<h2 class="heading">All Players</h2>
		</label><br><br>
	 <table width="80%" border="1" class="tablestyle">
		<thead style="color:white; font-size:20px">
		<center>	
			<th>Role</th>
			<th>Player Id</th>
			<th class="pn">Player Name</th>
			<th>Age</th>
			<th>Country</th>
			<th style="width: 300px">image</th>
			<th>Base Price</th>
			<th>Points</th>
			<th>Matches</th>
			<th>Status</th>
			<th>Batting Style</th>
			<th>Runs</th>
			<th>High Score</th>
			<th>Bowling Style</th>
			<th>Wickets</th>
			<th>Best Bowling</th>
		</center>
		</thead>
		<tbody>
			<?php
			error_reporting(E_ERROR|E_PARSE);
			$page = $_SERVER['PHP_SELF'];
 			$sec = "100";
 			header("Refresh: $sec; url=$page");
			$dbc=mysqli_connect("localhost","root","","ipl");
			$sql="select * from players p INNER JOIN batsman b on p.player_id=b.player_id";
			$result = mysqli_query($dbc,$sql);
				while( $row=mysqli_fetch_array($result))	
				{
					?> <tr style="font-size:20px"><td align="center" ><?php echo $row["role"];?></td>
					<td align="center"><?php echo $row["player_id"];?></td>
					<td align="center"><?php echo $row["player_name"];?></td>
					<td align="center"><?php echo $row["age"];?></td>
					<td align="center"><?php echo $row["country"];?></td>
					<td align="center"><img src="<?php echo $row["image"];?>" width="200" height="200" ></td>
					<td align="center"><?php echo $row["base_price"];?></td>
					<td align="center"><?php echo $row["points"];?></td>
					<td align="center"><?php echo $row["matches"];?></td>
					<td align="center" style="font-weight:bold;"><?php echo $row["status"];?></td>
					<td align="center"><?php echo $row["batting_style"];?></td>
					<td align="center"><?php echo $row["runs"];?></td>
					<td align="center"><?php echo $row["high_score"];?></td>
					<td align="center"><?php echo $row["bowling_style"];?></td>
					<td align="center"><?php echo $row["wickets"];?></td>
					<td align="center"><?php echo $row["best_bowl"];?></td>
				</tr>
				<?php 
				}
				$sql="select * from players p INNER JOIN wicket_keeper wk on p.player_id=wk.player_id";
				$result = mysqli_query($dbc,$sql);
				while( $row=mysqli_fetch_array($result))	
				{
					?> <tr style="font-size:20px"><td align="center" ><?php echo $row["role"];?></td>
					<td align="center"><?php echo $row["player_id"];?></td>
					<td align="center"><?php echo $row["player_name"];?></td>
					<td align="center"><?php echo $row["age"];?></td>
					<td align="center"><?php echo $row["country"];?></td>
					<td align="center"><img src="<?php echo $row["image"];?>" width="200" height="200" ></td>
					<td align="center"><?php echo $row["base_price"];?></td>
					<td align="center"><?php echo $row["points"];?></td>
					<td align="center"><?php echo $row["matches"];?></td>
					<td align="center" style="font-weight:bold;"><?php echo $row["status"];?></td>
					<td align="center"><?php echo $row["batting_style"];?></td>
					<td align="center"><?php echo $row["runs"];?></td>
					<td align="center"><?php echo $row["high_score"];?></td>
					<td align="center"><?php echo $row["bowling_style"];?></td>
					<td align="center"><?php echo $row["wickets"];?></td>
					<td align="center"><?php echo $row["best_bowl"];?></td>
				</tr>
				<?php 
				}
				$sql="select * from players p INNER JOIN all_rounder all1 on p.player_id=all1.player_id";
				$result = mysqli_query($dbc,$sql);

				while( $row=mysqli_fetch_array($result))	
				{
					?> <tr style="font-size:20px"><td align="center" ><?php echo $row["role"];?></td>
					<td align="center"><?php echo $row["player_id"];?></td>
					<td align="center"><?php echo $row["player_name"];?></td>
					<td align="center"><?php echo $row["age"];?></td>
					<td align="center"><?php echo $row["country"];?></td>
					<td align="center"><img src="<?php echo $row["image"];?>" width="200" height="200" ></td>
					<td align="center"><?php echo $row["base_price"];?></td>
					<td align="center"><?php echo $row["points"];?></td>
					<td align="center"><?php echo $row["matches"];?></td>
					<td align="center" style="font-weight:bold;"><?php echo $row["status"];?></td>
					<td align="center"><?php echo $row["batting_style"];?></td>
					<td align="center"><?php echo $row["runs"];?></td>
					<td align="center"><?php echo $row["high_score"];?></td>
					<td align="center"><?php echo $row["bowling_style"];?></td>
					<td align="center"><?php echo $row["wickets"];?></td>
					<td align="center"><?php echo $row["best_bowl"];?></td>
				</tr>
				<?php 
				}	
				$sql="select * from players p INNER JOIN bowler bo on p.player_id=bo.player_id";
				$result = mysqli_query($dbc,$sql);
				while( $row=mysqli_fetch_array($result))	
				{
					?> <tr style="font-size:20px"><td align="center" ><?php echo $row["role"];?></td>
					<td align="center"><?php echo $row["player_id"];?></td>
					<td align="center"><?php echo $row["player_name"];?></td>
					<td align="center"><?php echo $row["age"];?></td>
					<td align="center"><?php echo $row["country"];?></td>
					<td align="center"><img src="<?php echo $row["image"];?>" width="200" height="200" ></td>
					<td align="center"><?php echo $row["base_price"];?></td>
					<td align="center"><?php echo $row["points"];?></td>
					<td align="center"><?php echo $row["matches"];?></td>
					<td align="center" style="font-weight:bold;"><?php echo $row["status"];?></td>
					<td align="center"><?php echo $row["batting_style"];?></td>
					<td align="center"><?php echo $row["runs"];?></td>
					<td align="center"><?php echo $row["high_score"];?></td>
					<td align="center"><?php echo $row["bowling_style"];?></td>
					<td align="center"><?php echo $row["wickets"];?></td>
					<td align="center"><?php echo $row["best_bowl"];?></td>
				</tr>
				<?php 
				}	

		mysqli_close($dbc);
	?>
	</tbody>
	</table>
	</div>
</body>
</html>