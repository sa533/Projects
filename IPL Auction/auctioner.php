<?php
session_start();
if(!isset($_SESSION['username1']) )
header("location:index.html");
?>
<html>
	<head>
		<title>AUCTIONER PAGE</title>        
	<link rel="stylesheet" href="auctionercss.css">
	</head>
<body>
		<div class="MainBlock">
		<div class="heading">
		<br>AUCTIONER
		</div>
		<input type="submit" class="manage_Players" value="Manage Players" onclick="location.href='manageplayers.php'">
		<input type="submit" class="manage_Teams" value="Manage Teams" onclick="location.href='manageteams.php'">
		<input type="submit" class="auction_Player" value="Auction Player" onclick="location.href='auction_player.php'">		
		<input type="submit" class="sold_Player" value="Sold Players" onclick="location.href='sold_player.php'">

		<input type="submit" class="List_Team" value="List Team" onclick="location.href='list_teams.php'">
		<input type="submit" class="all_Players" value="All Players" onclick="location.href='allplayers.php'">
		<input type="submit" class="unsold_player" value="Unsold Players" onclick="location.href='unsold_player.php'">	
		<input type="submit" class="rules" value="Rules" onclick="location.href='rules.html'">
		</div>
</body>	
</html>