<?php
       //error_reporting(E_ERROR|E_PARSE);
       $dbc=mysqli_connect("localhost","root","","ipl");
         $username = $_POST['UserName'];
         $password = $_POST['Password'];
         $unikey=$_POST['uniquekey'];
         $key="GRABTHEBEAST";
         if ($unikey==$key) 
         {
                $result = mysqli_query($dbc,"INSERT into auctioner(username,password) values('$username','$password')")
                    or die('Failed to query database '.mysqli_error($dbc));            
                if(!$result)
                {
                	echo ("<script>
                            window.location.href='auctioner_register.html';
                            window.alert('Registration Unsuccessful. . . Try Again. . .');
                            </script>");                               
                }
                else
                {
                     echo ("<script>
                            window.location.href='auctionerlogin.html';
                            window.alert('Registration Successfully. . . Welcome Auctioner. . .');
                            </script>");        
                }
        }
        else
        {
        		echo ("<script>
                window.location.href='auctioner_register.html';
                window.alert('Registration Unsuccessful. . . Try Again. . .');
                </script>");
        }
        mysqli_close($dbc);
?>