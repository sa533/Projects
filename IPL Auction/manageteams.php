<?php
session_start();

if( !isset($_SESSION['team_name']) && !isset($_SESSION['username1']) )
header("location:index.html");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Team Details</title>
	<link rel="stylesheet" href="manageteamcss.css">

    <script type="text/javascript">
        function validadd()
        {
        	var exptn2 = /^[A-Z][A-Z]$/;
        	var exptn3 = /^[A-Z][A-Z][A-Z]$/;
        	var exptn4 = /^[A-Z][A-Z][A-Z][A-Z]$/;
        	var exptn5 = /^[A-Z][A-Z][A-Z][A-Z][A-Z]$/;

        	var tid = document.forms['manageteams']['teamid'];
            var tn  = document.forms['manageteams']['teamname'];
            var tp  = document.forms['manageteams']['Password'];
            var tb  = document.forms['manageteams']['teambal'];

            if(tid.value == '')
            {
                window.alert('Enter Team ID . . .');
                teamid.focus();
                return false;
            }

            if(tn.value == '')
            {
                window.alert('Enter Team Name Initials in UPPERCASE only . . .');
                teamname.focus();
                return false;
            }
            if(!tn.value.match(exptn2) && !tn.value.match(exptn3) && !tn.value.match(exptn4) && !tn.value.match(exptn5))
            {
            	window.alert('Enter Team Name Initials in UPPERCASE only with minimum length-2 to maximum length-5 . . .');
                teamname.focus();
                return false;
            }


            if(tp.value == '')
            {
                window.alert('Enter Password . . .');
                Password.focus();
                return false;
            }

            if(tb.value == '')
            {
                window.alert('Enter Team Balance . . .');
                teambal.focus();
                return false;
            }
        }

        function validsud()
        {
            var tn  = document.forms['manageteams']['teamname'];

            if(tn.value=="")
            {
                window.alert("Enter Team Name . . .");
                teamname.focus();
                return false;
            }
        }

    </script>

</head>
<body>
	<center>
	<div class="box">
		<center><h2 class="heading">Team Details</h2>
		<h1 class="subtitile">Select the Details of Team</h1></center>
		<h3 class="line"></h3>	
    <form name="manageteams" action="manageteams.php" method="POST">
    <?php
    $dbc=mysqli_connect("localhost","root","","ipl");   
    error_reporting(E_ERROR|E_PARSE);
	$Team_id=$_POST['teamid'];
    $sea_team = "Select * from teams where team_id='$Team_id' ";
    $result=mysqli_query($dbc, $sea_team);
    $row=mysqli_fetch_assoc($result);
    ?>
        <label class="other" for="Team Id">Team ID: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <input class="other" type="number" id="teamid" required value="<?php echo $row["team_id"];?>" name="teamid">
        <br>
        <label class="other" for="Team">Team Name: &nbsp&nbsp&nbsp</label>
        <input class="other" type="text" name="teamname" value="<?php echo $row["team_name"];?>" id="teamname">
        <br>
        <label class="other" for="Password">Team Password:</label>
        <input class="other" type="Password" id="teampass" value="<?php echo $row["password"];?>" name="teampass">
        <br>
        <label class="other" for="Team Id">
            Team Balance: &nbsp&nbsp&nbsp</label>
        <input class="other" type="number" id="teambal" value="<?php echo $row["balance"];?>" name="teambal">
        <br>        
        <label class="other" for="image">Team Logo: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<input class="other" type="file" id="image" value="<?php echo $row['image'];?>" name="image">
        <h3 class="line"></h3>     
        <input type="submit" name="submit" class="loginbtn" value="Add" id="Add">
        <input type="submit" name="submit" class="loginbtn" value="Search" id="Search">
        <input type="submit" name="submit" class="loginbtn" value="Update" id="Update">
        <input type="submit" name="submit" class="loginbtn" value="Delete" id="Delete">
    </form>
	</div>

<?php
    $dbc=mysqli_connect("localhost","root","","ipl");   
    error_reporting(E_ERROR|E_PARSE);
    $Team_id = $_POST['teamid'];
    $Team_name = $_POST['teamname'];
    $Password = $_POST['teampass'];
    $Balance=$_POST['teambal'];
    $Image=$_POST['image'];


    if($_POST['submit']=="Add")
	{

		$ins_team="INSERT INTO teams (team_id,team_name,password,balance,image) VALUES ('$Team_id','$Team_name','$Password','$Balance','$Image')";
        if(mysqli_query($dbc,$ins_team))
        {
            echo "Team Add Successfully";
        }
        else
        {
            echo "ERROR: Could not able to execute $ins_team.".mysqli_error($dbc);
        }
	}

    else if($_REQUEST['submit']=="Delete")
    {
        $del_team = "DELETE from teams where team_id='$Team_id'";
        if(mysqli_query($dbc, $del_team))
        {
            echo "Records deleted successfully.";
        } 
        else
        {
            echo "ERROR: Could not able to execute . " . mysqli_error($del_team);
        }
    }

    else if($_REQUEST['submit']=="Update")
    {
      $upd_team = "UPDATE teams SET team_id='$Team_id',team_name='$Team_name',password='$Password',balance='$Balance',image='$Image' WHERE team_id='$Team_id'";

        if(mysqli_query($dbc, $upd_team))
        {
            echo "Records updated successfully.";
        } 
        else
        {
            echo "ERROR: Could not able to execute $upd_player. " . mysqli_error($upd_team);
        }
    }

    else if($_POST['submit']=="Search")
    {

        $Team_id=$_POST['teamid'];
        $sea_team = "Select * from teams where team_id='$Team_id' ";
	?>
        <table width="80%" border="1" style="border-collapse:collapse;">
        <thead style="color:blue; font-size:20px">
            <th>Team Id</th>
            <th>Team Name</th>
            <th>Password</th>
            <th>Balance</th>
            <th>Team Logo</th>
        </thead>
            <?php
            $result=mysqli_query($dbc, $sea_team);
            $row=mysqli_fetch_assoc($result);
        ?>
            <tbody>
            <tr><td align="center"><?php echo $row["team_id"];?></td>
                <td align="center"><?php echo $row["team_name"];?></td>
                <td align="center"><?php echo $row["password"];?></td>
                <td align="center"><?php echo $row["balance"];?></td>
                <td align="center"><img src="<?php echo $row['image'];?>" width="100" height="100" ></td>
            </tr>
        </tbody>
        </table>
    <?php
    }
    mysqli_close($dbc);
?>
	</center>
     </body>
</html>