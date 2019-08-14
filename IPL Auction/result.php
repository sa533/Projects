<!DOCTYPE html>
<html>
<head>
	<title>Auction Result</title>
	<link rel="stylesheet" href="auction_player.css">
</head>
<body>
<header>
		<img src="avatar.jpg">
		<div class="data">
			<h1>IPL AUCTION 2018</h1>
			<br>
			<h2>The Game For Cricket Lover</h2>
		</div>	
		</header>
<form name="Report" action="FPDF\report.php" method="POST">
<input type="submit" value="All Player Report" name="all_reports">
<input type="submit" value="Sold Player Report" name="sold_players_reports">
<input type="submit" value="Unsold Player Report" name="unsold_players_reports">
<input type="submit" value="Analysis" name="analysis">
</form>
<form name="End_Session" action="logout.php" method="POST">
<input type="submit" value="Exit" name="End_Session">
</form>
<?php 
		$dbc=mysqli_connect("localhost","root","","ipl");	
		//error_reporting(E_ERROR|E_PARSE);
		for ($i=1; $i <8 ; $i++)
		{ 
			$sel_team="SELECT count(player_id) FROM sold_players where team_id=$i";
			$result=mysqli_query($dbc, $sel_team);
			$row=mysqli_fetch_assoc($result);
			$Tp=$row['count(player_id)'];
			$sel_bats="SELECT count(player_id) FROM sold_players where team_id=$i and role='BATSMAN'";
			$result_bats=mysqli_query($dbc, $sel_bats);
			$row_bats=mysqli_fetch_assoc($result_bats);
			$Bct=$row_bats['count(player_id)'];
			$sel_wk="SELECT count(player_id) FROM sold_players where team_id=$i and role='WICKET_KEEPER'";
			$result_wk=mysqli_query($dbc, $sel_wk);
			$row_wk=mysqli_fetch_assoc($result_wk);
			$Wkct=$row_wk['count(player_id)'];
			$sel_all="SELECT count(player_id) FROM sold_players where team_id=$i and role='ALL_ROUNDER'";
			$result_all=mysqli_query($dbc, $sel_all);
			$row_all=mysqli_fetch_assoc($result_all);
			$Allct=$row_all['count(player_id)'];
			$sel_bow="SELECT count(player_id) FROM sold_players where team_id=$i and role='BOWLER'";
			$result_bow=mysqli_query($dbc, $sel_bow);
			$row_bow=mysqli_fetch_assoc($result_bow);
			$Boct=$row_bow['count(player_id)'];
			$sel_bow="SELECT sum(points) FROM sold_players where team_id=$i";
			$result_bow=mysqli_query($dbc, $sel_bow);
			$row_bow=mysqli_fetch_assoc($result_bow);
			$Tpnts=$row_bow['sum(points)'];
			$sel_teamname="SELECT team_name FROM sold_players where team_id=$i";
			$result_tn=mysqli_query($dbc, $sel_teamname);
			$row_tn=mysqli_fetch_assoc($result_tn);
			$Tn=$row_tn['team_name'];
			$ins_result="INSERT INTO result (team_id,team_name,total_player_ct,batsman_ct,wicket_keeper_ct,all_rounder_ct,bowler_ct,total_points) VALUES ($i,'$Tn',$Tp,$Bct,$Wkct,$Allct,$Boct,$Tpnts)";
			mysqli_query($dbc,$ins_result);
		}
		$sel_win="SELECT team_name,total_points,total_player_ct FROM result where total_player_ct>10 and total_player_ct<16 and batsman_ct>0 and wicket_keeper_ct>0 and all_rounder_ct>0 and bowler_ct>2 ORDER BY total_points desc LIMIT 1";
		$result_win=mysqli_query($dbc, $sel_win);
		if($row_win=mysqli_fetch_assoc($result_win))
		{
			echo "<center><p><span style='font-family:TimesnewRoman;font-size:40px;color:darkblue'><b>Winner Team of IPL Auction</b></span><br>";
			echo "<span style='font-family:TimesnewRoman;font-size:30px;color:brown'><b>Team: ".$row_win['team_name']."</b></span><br>";
			echo "<span style='font-family:TimesnewRoman;font-size:30px;color:brown'><b>Points: ".$row_win['total_points']."</b></span><br>";
			echo "<span style='font-family:TimesnewRoman;font-size:30px;color:brown'><b>Total Players: ".$row_win['total_player_ct']."</b></span></p></center>";
		}
		else 	
		{
			echo "<center><p><span style='font-family:TimesnewRoman;font-size:30px;color:darkblue'><b>No Winner Found Till Now</b></span><br></center>";	
		}	
 ?>
</body>
</html>