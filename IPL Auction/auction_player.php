<?php
session_start();
if( !isset($_SESSION['username1']) )
header("location:index.html");
error_reporting(E_ERROR |E_PARSE);
$auctioner=$_SESSION['username1'];
?>
<html>
    <head>
        <tittle>IPL AUCTION 2018</tittle>
        <link rel="stylesheet" href="auction_player.css">
        <?php echo "Login As auctioner: ".$_SESSION['username1']; ?>
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
    <br>
    <br>
    <div class="main_header">
	<div class="img_header">
	
	<?php
		$dbc=mysqli_connect("localhost","root","","ipl");	
		error_reporting(E_ERROR|E_PARSE);
		$page = $_SERVER['PHP_SELF'];
 		$sec = "10";
 		header("Refresh: $sec; url=$page");
 		if(isset($_POST['playerid']))
 		{
 		$Pid=$_POST['playerid'];
 		$_SESSION['playerid']=$Pid;
		$sea_player = "Select * from players where player_id='$Pid' ";
		$result=mysqli_query($dbc, $sea_player);
		$row=mysqli_fetch_assoc($result);
		
    	$Prole=$row['role'];
		$Pid=$row['player_id'];
		$Pname=$row['player_name'];
		$BPrice=$row['base_price'];
		$Points=$row['points'];
		if($lastbid!=0)
		{
			$inc=$lastbid*0.2;
			$Bid=$lastbid+$inc;
		}
		else
		{
			$Bid=$row['base_price'];
		}
		$ins_bid="INSERT INTO bids (role,player_id,player_name,base_price,points,team_name,bid_price) values ('$Prole',$Pid,'$Pname',$BPrice,$Points,'Auction Started',0)";
		if($result_bid=mysqli_query($dbc,$ins_bid))
		{
			echo "Player Added";
			header("location: auction_player.php");
		}
		else
		{
			echo "Error".mysql_error($result_bid);
		}
			$Player_id=$_SESSION['playerid'];
		}
		$Player_id=$_SESSION['playerid'];
			$sea_player = "Select * from players where player_id='$Player_id'";
			$result=mysqli_query($dbc, $sea_player);
			$row=mysqli_fetch_assoc($result);
		
			if($row['role']=="BATSMAN")
			{
				$sea_bats = "SELECT * from batsman where player_id='$Player_id'";
				$result=mysqli_query($dbc, $sea_bats);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="WICKET_KEEPER")
			{
				$sea_wk = "SELECT *  from wicket_keeper where player_id='$Player_id'";
				$result=mysqli_query($dbc, $sea_wk);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="BOWLER")
			{
				$sea_bol = "SELECT * from bowler where player_id='$Player_id'";
				$result=mysqli_query($dbc, $sea_bol);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="ALL_ROUNDER")
			{
				$sea_all1 = "SELECT * from all_rounder where player_id='$Player_id'";
				$result=mysqli_query($dbc, $sea_all1);
				$row1=mysqli_fetch_assoc($result);
			}
			else
			{
				echo "<p style='color:white'>Please Select Player To Auction</p>";
			}
		
	    ?>		

  <h2>Player Profile</h2>
  <input type="submit" value="End Auction" name="End_Auction" onclick="location.href='result.php'">
  <img class="player_profile" src="<?php echo $row['image'];?>">
	 <table>
	 <tr>
	 	<form method="post">
  		<input type="submit" value="Sold" name="sold" id="Sold">
  		</form>
  		<form method="post">
  		<input type="submit" value="Unsold" name="unsold" id="Sold">
  		</form>
		<th>Player id</th>
		<th>Name</th>
		<th>Base Price</th>
		<th>Age</th>
		<th>Points</th>
		</tr>
		<tr>
		<td align="center"><?php echo $row["player_id"];?></td>
		<td align="center"><?php echo $row["player_name"];?></td>
		<td align="center"><?php echo $row["base_price"];?></td>
		<td align="center"><?php echo $row["age"];?></td>
		<td align="center"><?php echo $row["points"];?></td>
		</tr>	
	</table>	
    </div>
    <div class="player_header">
	<h2>Performance Details</h2>
	<table>
		<form name="auctionplayer" action="auction_player.php"  method="POST">
		<tr><th><label">Player Id:</label></th>
		<th><input type="number" id="playerid" name="playerid" value="<?php echo $_SESSION['playerid'];?>" style="width:60px"></th>
	  	<th><input type="submit" name="submit" value="set Player" id="view_player"></th></tr></form>
		<tr>
		<th>Role</th>
		<th>Matches</th>
		<th>Country</th>
		</tr>
		<tr>
		<td align="center"><?php echo $row["role"];?></td>
		<td align="center"><?php echo $row["matches"];?></td>
		<td align="center"><?php echo $row["country"];?></td>
		</tr>	
	</table>
	<br>
	<br>
	<table>
		<tr>
		<th>Bating Style</th>
		<th>Runs</th>
		<th>High Score</th>
		</tr>
		<tr>
		<td align="center"><?php echo $row1["batting_style"];?></td>
		<td align="center"><?php echo $row1["runs"];?></td>
		<td align="center"><?php echo $row1["high_score"];?></td>
		</tr>	
	</table>
	<br>
	<br>
	<table>
		<tr>
		<th>Bowling Style</th>
		<th>Wicket</th>
		<th>Best-Bowling</th>
		</tr>
		<tr>
		<td align="center"><?php echo $row1["bowling_style"];?></td>
		<td align="center"><?php echo $row1["wickets"];?></td>
		<td align="center"><?php echo $row1["best_bowl"];?></td>
		</tr>	
	</table>	
    </div>
    <div class="team_header">
    <table>
		<tr>
		<th>Team Id</th>
		<th>Team Icon</th>
		<th>Team Name</th>
		<th>Balance</th>
		</tr>
		<tr>
			<?php  
			$sea_teams="select * from teams";
			$result_team = mysqli_query($dbc,$sea_teams);
				while( $row_team=mysqli_fetch_array($result_team))	
				{
					?><tr><td><?php echo $row_team["team_id"];?></td>
					<td style="width:30px height:30px"><img class="smalllogo" src="<?php echo $row_team['image'];?>">
					<td align="center"><?php echo $row_team["team_name"];?></td>
					<td align="center"><?php echo $row_team["balance"];?></td>
					<td></td>	
					</tr>

               <?php 	
			   }	
	?>
	
	</table>	
	</div>
    <div class="down_header">
	<div class="left">
	<br>
	</div>
	  <table>
	  	<h2 style="float:left; ">Current Biding Statistics</h2>
	    <tr>
	    <th>Role</th>
		<th>Player id</th>
		<th>Player Name</th>
		<th>Team Name</th>
		<th>Base Price</th>
		<th>Points</th>
		<th>Bid Price</th>
		</tr>
			<?php 
			$sea_bids="SELECT * FROM bids ORDER BY bid_price DESC LIMIT 5";
			$result_bids = mysqli_query($dbc,$sea_bids);
				while($row_bids=mysqli_fetch_assoc($result_bids))	
				{
			 	?><tr><td><?php echo $row_bids['role'];?></td>
					<td><?php echo $row_bids['player_id'];?></td>
					<td style="width:50px"><?php echo $row_bids["player_name"];?></td>
					<td><?php echo $row_bids["team_name"];?></td>
					<td><?php echo $row_bids["base_price"];?></td>
					<td><?php echo $row_bids["points"];?></td>
					<td><?php echo $row_bids["bid_price"];?></td>
				</tr>
            <?php 
			}
			$sea_last_bids="SELECT * FROM bids ORDER BY bid_price DESC LIMIT 1";
			$result_last_bids = mysqli_query($dbc,$sea_bids);
            $row_last_bids=mysqli_fetch_assoc($result_last_bids);	
            $lastbid=$row_last_bids['bid_price'];
	?>
	<?php
    $Team_id = $_POST['teamid'];
    $Team_name = $_POST['teamname'];
    $Password = $_POST['teampass'];
    $Balance=$_POST['teambal'];
    $Image=$_POST['image'];

    if(isset($_POST['sold']))
	{

		if(mysqli_query($dbc,"call sold_cpy()"))
		{
			echo 'Player Sold';
		}
		else
		{
				echo'Error :'.mysqli_error($dbc);
		}
	}

    if(isset($_POST['unsold']))
    {
        if(mysqli_query($dbc,"call unsold_cpy()"))
        {
        	echo'Player Unsold';
        }
        else
        {
        	echo'Error:'.mysqli_error($dbc);
        }
    }
    
    
	mysqli_close($dbc);
?>
</form>
</body>    
</html>