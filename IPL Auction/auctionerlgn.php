<?php
session_start();
       error_reporting(E_ERROR|E_PARSE);
       $dbc=mysqli_connect("localhost","root","","ipl");
         $username = $_POST['UserName'];
            $password = $_POST['Password'];
            $username = stripcslashes($username);
            $password = stripcslashes($password);
            $username = mysqli_real_escape_string($dbc,$username);
            $password = mysqli_real_escape_string($dbc,$password);

                $result = mysqli_query($dbc,"select * from auctioner where username= '$username' and password = '$password'")
                    or die('Failed to query database '.mysqli_error($dbc));
                $row = mysqli_fetch_array($result);
                
                if($row['username'] == $username && $row['password'] ==  $password)
                {
                    $_SESSION["username1"]=$username;
                    echo ("<script>
                            window.location.href='auctioner.php';
                            window.alert('Loginned Successfully. . . Welcome Auctioner. . .');
                            </script>");                                
                }
                else
                {
                    echo ("<script>
                            window.location.href='auctionerlogin.html';
                            window.alert('Login Unsuccessful. . . Try Again. . .');
                            </script>");                                
                        
                }
        mysqli_close($dbc);
?>