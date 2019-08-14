<?php
session_start();
if(!isset($_SESSION['username1']) )
header("location:index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<center>
	<title>Player Details</title>
	<link rel="stylesheet" href="manageplayerscss.css">

	<script type="text/javascript">
		function validadd()		
		{
			var exppn = /^[A-Z a-z]+$/;
			var expcn = /^[A-Z]+$/;
			var expbb1 = /^[0-9][/][0-9]$/;
			var expbb2 = /^[0-9][0-9][/][0-9]$/;
			var expbb3 = /^[0-9][0-9][0-9][/][0-9]$/;

			if(!bb.value.match(expbb1) && !bb.value.match(expbb2) && !bb.value.match(expbb3))
			{
					window.alert("Please check the format . . .");
					Best_bowl.focus();
					return false;
			}

			if(!ct.value.match(expcn))
				{
					window.alert("Player Name Should contain only Alphabets . . .");
					country.focus();
					return false;
				}
				if(!bb.value.match(expbb1) && !bb.value.match(expbb2) && !bb.value.match(expbb3))
				{
					window.alert("Please check the format . . .");
					Best_bowl.focus();
					return false;
				}
		}
	</script>
</head>
<body>
	<div class="box">
		<h2 class="heading">Player Details</h2>
		<h1 class="subtitile">Select the role of the Player</h1>

		
<form name="manageplayers" action="manageplayers.php" method="POST">
        
        <label class="container">BATSMAN<input type="radio" checked="checked" name="role" value="BATSMAN" id="BATSMAN" 
        	onclick="document.getElementById('Wickets').disabled = true;
        	document.getElementById('Best_bowl').disabled = true;
        	document.getElementById('Bowling_Style').disabled = true; 
        	document.getElementById('Runs').disabled = false; 
        	document.getElementById('High_Score').disabled = false; 
        	document.getElementById('Batting_Style').disabled = false;">
        <span class="checkmark"></span>
        </label>

		<label class="container">WICKET-KEEPER<input type="radio" checked="checked" name="role" value="WICKET_KEEPER" id="WICKET_KEEPER" 
			onclick="document.getElementById('Wickets').disabled = true; 
			document.getElementById('Best_bowl').disabled = true;
			document.getElementById('Bowling_Style').disabled = true;
			document.getElementById('Runs').disabled = false; 
			document.getElementById('High_Score').disabled = false; 
			document.getElementById('Batting_Style').disabled = false;">
		<span class="checkmark"></span>
		</label>

		<label class="container">Bowler<input type="radio" checked="checked" name="role" value="BOWLER" id="BOWLER" 
			onclick="document.getElementById('Runs').disabled = true; 
			document.getElementById('High_Score').disabled = true; 
			document.getElementById('Batting_Style').disabled = true;
			document.getElementById('Wickets').disabled = false; 
			document.getElementById('Best_bowl').disabled = false; 
			document.getElementById('Bowling_Style').disabled = false;">
		<span class="checkmark"></span>

		<label class="container">ALL-Rounder<input type="radio" checked="checked" name="role" value="ALL_ROUNDER" id="ALL_ROUNDER" 
			onclick="document.getElementById('Runs').disabled =false;
			document.getElementById('High_Score').disabled = false; 
			document.getElementById('Batting_Style').disabled = false;
			document.getElementById('Wickets').disabled = false; 
			document.getElementById('Best_bowl').disabled = false; 
			document.getElementById('Bowling_Style').disabled = false;">
		<span class="checkmark"></span>
		
		</label>		
		</label>	

        <h3 class="line"></h3>         
        <h1 class="subtitile">Player Other Details</h1>
        <?php
		$dbc=mysqli_connect("localhost","root","","ipl");	
		error_reporting(E_ERROR|E_PARSE);
        $Player_id=$_POST['playerid'];
		$sea_player = "Select * from players where player_id='$Player_id' ";
		$result=mysqli_query($dbc, $sea_player);
		$row=mysqli_fetch_assoc($result);
			$result=mysqli_query($dbc, $sea_player);
			$row=mysqli_fetch_assoc($result);
			if($row['role']=="BATSMAN")
			{
				$sea_bats = "SELECT * from batsman where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_bats);
				$result=mysqli_query($dbc, $sea_bats);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="WICKET_KEEPER")
			{
				$sea_wk = "SELECT *  from wicket_keeper where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_wk);
				$result=mysqli_query($dbc, $sea_wk);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="BOWLER")
			{
				$sea_bol = "SELECT * from bowler where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_bol);
				$result=mysqli_query($dbc, $sea_bol);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="ALL_ROUNDER")
			{
				$sea_all1 = "SELECT * from all_rounder where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_all1);
				$result=mysqli_query($dbc, $sea_all1);
				$row1=mysqli_fetch_assoc($result);
			}
		?>
        <label class="other" for="playerid">Player ID: &nbsp</label>
        <input class="other" type="number" id="playerid" name="playerid" required value="<?php echo $row["player_id"];?>" placeholder="Enter Player ID">

        <label class="other" for="playername">Player Name:</label>
        <input class="other" type="text" id="playername" name="playername" value="<?php echo $row["player_name"];?>" placeholder="Enter Player Name">

        <label class="other" for="playerage">Player Age:</label>
        <input class="other" type="number" id="playerage" name="playerage" value="<?php echo $row["age"];?>" placeholder="Enter Age">

        <label class="other" for="Country_Team">Country:  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>    
  
	    <input class="other" type="text" id="country" name="country" value="<?php echo $row["country"];?>" placeholder="Enter Player Name Country">
		<label class="other" for="image">Player Img:</label>
		<input class="other" name="image" type="file" id="image" value="<?php echo $row['image'];?>">         
			
		<label class="other" for="base_price">Base Price: &nbsp&nbsp&nbsp</label>         
		<input class="other" type="number" id="Base_price" name="base_price" value="<?php echo $row["base_price"];?>" placeholder="Enter Base Price">

		<label class="other" for="Points">Points: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>         
		<input class="other" type="number" id="Points" name="Points" value="<?php echo $row["points"];?>" placeholder="Enter Points">         
			
		<label class="other" for="Matches">Matches:  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>  
		<input class="other" type="number" id="Matches" name="Matches" value="<?php echo $row["matches"];?>" placeholder="Enter Matches">         
								
		<label class="other" for="Batting_Style">Bating Style:</label>         
		<select class="other" id="Batting_Style" name="Batting_Style" >             
			<option value="<?php echo $row["status"];?>">Select Batting_Style</option>             
			<option value="RIGHT-HANDED">RIGHT-HANDED</option>             
			<option value="LEFT-HANDED">LEFT-HANDED</option>         
		</select>  

		<label class="other" for="Runs">Runs: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>         
		<input class="other" type="number" id="Runs" name="Runs" value="<?php echo $row1["runs"];?>" placeholder="Enter Runs"> </span> 

		<label class="other" for="High_Score">High Score:</label>         
		<input class="other" type="number" id="High_Score" name="High_Score" value="<?php echo $row1["high_score"];?>" placeholder="Enter High Score"> 

		<label class="other" for="Bowling_Style">Bowling Style:</label>         
		<select class="other" id="Bowling_Style"  name="Bowling_Style">      
			<option value="">Select Bowling Style </option>           
			<option value="RIGHT-ARM-OFF-SPIN">RIGHT-ARM-OFF-SPIN</option> 
			<option value="RIGHT-ARM-MEDIUM-FAST">RIGHT-ARM-MEDIUM-FAST</option>
			<option value="RIGHT-ARM-FAST">RIGHT-ARM-FAST</option>      
			<option value="LEFT-ARM-ORTHODOX-SPIN">LEFT-ARM-ORTHODOX-SPIN</option>                 
			<option value="LEFT-ARM-MEDIUM-FAST">LEFT-ARM-MEDIUM-FAST</option>   
			<option value="LEFT-ARM-FAST">LEFT-ARM-FAST</option>      
		</select>     

		<label class="other" for="Wickets">Wickets: &nbsp&nbsp&nbsp&nbsp</label>         
		<input class="other" type="number" id="Wickets" name="Wickets"value="<?php echo $row1["wickets"];?>" placeholder="Enter Wickets">         

		<label class="other" for="Best_bowl">Best Bowling: </label>         
		<input class="other" type="text" id="Best_bowl" name="Best_bowl" value="<?php echo $row1["best_bowl"];?>" placeholder="Enter Best bowling(eg:-20/4)">

		<h3 class="line"></h3>  


		<input type="submit" class="loginbtn" name="submit" value="Add" id="Add">
		<input type="submit" class="loginbtn" name="submit" value="Search" id="Search">         
		<input type="submit" class="loginbtn" name="submit" value="Update" id="Update">         
		<input type="submit" class="loginbtn" name="submit" value="Delete" id="Delete">
</form>

	</div>  

<?php
	$dbc=mysqli_connect("localhost","root","","ipl");	
	error_reporting(E_ERROR|E_PARSE);
	$Role = $_POST['role'];
	$Player_id = $_POST['playerid'];
	$Player_name = $_POST['playername'];
	$Age=$_POST['playerage'];
	$Country=$_POST['country'];
	$Image=$_POST['image'];
	$Base_price=$_POST['base_price'];
	$Points=$_POST['Points'];
	$Matches=$_POST['Matches'];

	if($_POST['submit']=="Add")
	{

		$ins_player="INSERT INTO players(role,player_id,player_name,age,country,image,base_price,points,matches,status) VALUES ('$Role','$Player_id','$Player_name','$Age','$Country','$Image','$Base_price','$Points','$Matches','')";

		if(mysqli_query($dbc,$ins_player))
		{
			if($Role=='BATSMAN')
			{
				$Batting_Style=$_POST['Batting_Style'];
				$Runs=$_POST['Runs'];
				$High_Score=$_POST['High_Score'];
				$ins_batsman="INSERT INTO batsman(player_id,batting_style,runs,high_score) VALUES ('$Player_id','$Batting_Style','$Runs','$High_Score')";
				mysqli_query($dbc,$ins_batsman);
				echo "Batsman Records added successfully.";
			}
			elseif($Role=='WICKET_KEEPER')
			{
				$Batting_Style=$_POST['Batting_Style'];
				$Runs=$_POST['Runs'];
				$High_Score=$_POST['High_Score'];
				$ins_wk="INSERT INTO wicket_keeper(player_id,batting_style,runs,high_score) VALUES ('$Player_id','$Batting_Style','$Runs','$High_Score')";
				mysqli_query($dbc,$ins_wk);
				echo "Wicket Kepeer Records added successfully.";
			}
			elseif($Role=='ALL_ROUNDER')
			{
				$Batting_Style=$_POST['Batting_Style'];
				$Runs=$_POST['Runs'];
				$High_Score=$_POST['High_Score'];
				$Bowling_Style=$_POST['Bowling_Style'];
				$Wickets=$_POST['Wickets'];
				$Best_bowl=$_POST['Best_bowl'];
				$ins_all_round="INSERT INTO all_rounder(player_id,batting_style,runs,high_score,bowling_style,wickets,best_bowl) VALUES ('$Player_id','$Batting_Style','$Runs','$High_Score','$Bowling_Style','$Wickets','$Best_bowl')";
				mysqli_query($dbc,$ins_all_round);
				echo "All Rounder Records added successfully.";
			}
			elseif($Role=='BOWLER')
			{
				$Bowling_Style=$_POST['Bowling_Style'];
				$Wickets=$_POST['Wickets'];
				$Best_bowl=$_POST['Best_bowl'];
				$ins_bowler="INSERT INTO bowler(player_id,bowling_style,wickets,best_bowl) VALUES ('$Player_id','$Bowling_Style','$Wickets','$Best_bowl')";
				mysqli_query($dbc,$ins_bowler);
				echo "Bowler Records added successfully.";
			}
		    else
			{
		    	echo "ERROR: Could not able to execute.".mysqli_error($dbc);
			}
		}
	}
	else if($_REQUEST['submit']=="Delete")
	{
		$player="SELECT role from players where player_id='$Player_id'";
		$del_player = "DELETE from players where player_id='$Player_id'";
		$result=mysqli_query($dbc, $player);
		$row=mysqli_fetch_assoc($result);
		if(mysqli_query($dbc, $del_player))
		{
			if($row['role']=="BATSMAN")
			{
				$del_bats = "DELETE from batsman where player_id='$Player_id'";
				mysqli_query($dbc, $del_bats);
				echo " Batsman Records deleted successfully.";
			}
			elseif ($row['role']=="WICKET_KEEPER")
			{
				$del_wk = "DELETE from wicket_keeper where player_id='$Player_id'";
				mysqli_query($dbc, $del_wk);
				 echo "Wicket Kepeer Records deleted successfully.";
			}
			elseif ($row['role']=="BOWLER")
			{
				$del_bol = "DELETE from bowler where player_id='$Player_id'";
				mysqli_query($dbc, $del_bol);
				 echo "Bowler Records deleted successfully.";
			}
			elseif ($row['role']=="ALL_ROUNDER")
			{
				$del_all1 = "DELETE from all_rounder where player_id='$Player_id'";
				mysqli_query($dbc, $del_all1);
				 echo "All Rounder Records deleted successfully.";
			}
		    else
		    {
		    	echo "ERROR To Delete role Not Specified";
		    }
		} 
		else{
		    echo "ERROR: Could not able to execute $del_player. " . mysqli_error($del_player);
		}
	}

	else if($_REQUEST['submit']=="Update")
	{
		$player="SELECT role from players where player_id='$Player_id'";
		$upd_player = "UPDATE players SET player_id='$Player_id',player_name='$Player_name',age='$Age',country='$Country',image='$Image',base_price='$Base_price', points='$Points',matches='$Matches' WHERE player_id='$Player_id' ";
			$result=mysqli_query($dbc, $player);
			$row=mysqli_fetch_assoc($result);
		
		if(mysqli_query($dbc, $upd_player))
		{
			if($row['role']=="BATSMAN")
			{
				$sea_bats = "SELECT * from batsman where player_id='$Player_id'";
				$upd_bats = "UPDATE batsman SET player_id='$Player_id',batting_style='$Batting_Style',run='$Runs',high_score='$High_Score'";
				mysqli_query($dbc, $upd_bats);
				echo "Batsman Records updated successfully.";
			}
			elseif ($row['role']=="WICKET_KEEPER")
			{
				$sea_wk = "SELECT *  from wicket_keeper where player_id='$Player_id'";
				$upd_wk = "UPDATE wicket_keeper SET player_id='$Player_id',batting_style='$Batting_Style',run='$Runs',high_score='$High_Score'";
				mysqli_query($dbc, $upd_wk);
				echo "Wicket Kepeer Records updated successfully.";
				
			}
			elseif ($row['role']=="BOWLER")
			{
				$sea_bol = "SELECT * from bowler where player_id='$Player_id'";
				$upd_bol = "UPDATE bowler SET player_id='$Player_id',bowling_style='$Bowling_Style',wickets='$Wickets',best_bowl='$Best_bowl'";
				mysqli_query($dbc, $upd_bol);
				echo "Bowler Records updated successfully.";
				
			}
			elseif ($row['role']=="ALL_ROUNDER")
			{
				$sea_all1 = "SELECT * from all_rounder where player_id='$Player_id'";
				$upd_bol = "UPDATE bowler SET player_id='$Player_id',batting_style='$Batting_Style',run='$Runs',high_score='$High_Score', bowling_style='$Bowling_Style',wickets='$Wickets',best_bowl='$Best_bowl'";
				mysqli_query($dbc, $upd_all1);
				echo "All Rounder Records updated successfully.";
			}
		    else
		    {
		    	echo "ERROR To Update role Not Specified";
		    } 
		} 
		else
		{
		    echo "ERROR: Could not able to execute $upd_player. " . mysqli_error($dbc);
		}
	}
	else if($_POST['submit']=="Search")
	{

		$Player_id=$_POST['playerid'];
		$sea_player = "Select * from players where player_id='$Player_id' ";
	?>
		<table width="100%" border="1" style="border-collapse:collapse;">
		<thead style="color:blue; font-size:20px">
			<th>Role</th>
			<th>Player Id</th>
			<th>Player Name</th>
			<th>Age</th>
			<th>Country</th>
			<th>image</th>
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
		</thead>
			<?php
			$result=mysqli_query($dbc, $sea_player);
			$row=mysqli_fetch_assoc($result);
			if($row['role']=="BATSMAN")
			{
				$sea_bats = "SELECT * from batsman where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_bats);
				$result=mysqli_query($dbc, $sea_bats);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="WICKET_KEEPER")
			{
				$sea_wk = "SELECT *  from wicket_keeper where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_wk);
				$result=mysqli_query($dbc, $sea_wk);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="BOWLER")
			{
				$sea_bol = "SELECT * from bowler where player_id='$Player_id'";
				mysqli_query($dbc, $sea_bol);
				$result=mysqli_query($dbc, $sea_bol);
				$row1=mysqli_fetch_assoc($result);
			}
			elseif ($row['role']=="ALL_ROUNDER")
			{
				$sea_all1 = "SELECT * from all_rounder where player_id='$Player_id'";
				//mysqli_query($dbc, $sea_all1);
				$result=mysqli_query($dbc, $sea_all1);
				$row1=mysqli_fetch_assoc($result);
			}
		else
		{
		   	echo "ERROR To Search role Not Specified";
		} 
	    ?>
	    	<tbody>
	    	<tr><td align="center"><?php echo $row["role"];?></td>
				<td align="center"><?php echo $row["player_id"];?></td>
				<td align="center"><?php echo $row["player_name"];?></td>
				<td align="center"><?php echo $row["age"];?></td>
				<td align="center"><?php echo $row["country"];?></td>
				<td align="center"><img src="<?php echo $row['image'];?>" width="100" height="100" ></td>
				<td align="center"><?php echo $row["base_price"];?></td>
				<td align="center"><?php echo $row["points"];?></td>
				<td align="center"><?php echo $row["matches"];?></td>
				<td align="center"><?php echo $row["status"];?></td>
				<td align="center"><?php echo $row1["batting_style"];?></td>
				<td align="center"><?php echo $row1["runs"];?></td>
				<td align="center"><?php echo $row1["high_score"];?></td>
				<td align="center"><?php echo $row1["bowling_style"];?></td>
				<td align="center"><?php echo $row1["wickets"];?></td>
				<td align="center"><?php echo $row1["best_bowl"];?></td>
			</tr>
		</tbody>
	    </table>
	</center>
	<?php
	}
	mysqli_close($dbc);
?>
	 </body>
</html>