<?php
/**
 * BackEndLogin, created by TuxSoft Limited <tuxsoft@tuxsoft.uk> 2017.  
 * BackEndLogin is a PHP plugin to allow websites to create a BackEnd page with a secure login form to restrict access.
 * 
 * Copyright (C) 2017 TuxSoft Limited, Released under the GNU GPL v3.0 or later.
 * 
 * This program is free software: you can redistribute it and/or modify it under the terms of the 
 * GNU General Public License as published by the Free Software Foundation, either version 3 of the License, 
 * or (at your option) any later version.  This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.   
 * You should have received a copy of the GNU General Public License along with this program.
 * If not, see <http://www.gnu.org/licenses/>.
 * 
**/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="robots" content="noindex, nofollow"><!-- Stop bots following you -->
		<title>BackEnd Login | By TuxSoft Limited</title><!-- Customize your title -->
		<link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu" rel="stylesheet" /><!-- Some nice fonts, apply as you wish. -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script><!-- Use jQuery for graphical effects -->
	<head>
	<body>
		<!-- Here's your login form -->
		<form action="" method="post" id="LoginForm">
			<p>Name:</p> <input type="text" name="User" /><br />
			<p>Password:</p><input type="password" name="Password" /><br />
			<input type="submit" value="Submit" />  
		</form>
<?php
	include("../DataBaseDetails.inc"); //include the login details stored above the web root.
	if (isset($_POST['User']) && isset($_POST['Password'])) //if the user has input username and password
	{
		$UserValid = 0; //variable to check if the user's input is a valid user
		$User = $_POST['User'];
		$Password = $_POST['Password'];
		$DBConnection = mysqli_connect($DBSERVER,$DBUSER,$DBPASS,$DBASE); //use variables from ../DataBaseDetails.inc to connect to the database.
		if (!$DBConnection)
		{
			die('Could not connect: ' . mysqli_connect_error());
		}
		$PasswordSalt = ""; //INSERT YOUR SALT HERE
		$Password = md5($Password . $PasswordSalt); //create an md5 hashed and salted password
		$User = mysqli_real_escape_string($DBConnection, $User); //prevent SQL injection attack
		$Password = mysqli_real_escape_string($DBConnection, $Password);
		$User = mb_convert_encoding($User, "UTF-8"); //make sure the input's all UTF-8
		$Password = mb_convert_encoding($Password, "UTF-8");
		$MySQLQuery = mysqli_query($DBConnection, "SELECT * FROM `LoginTable` WHERE ID>0;"); //pull the login table from the database
		while($EachDBRow = mysqli_fetch_array($MySQLQuery, MYSQLI_ASSOC))
		{
			if ($EachDBRow['User'] == $User && $EachDBRow['Pass'] == $Password) //if both username and password match the value in the database, mark the user valid.
			{
				$UserValid = 1;
			}
		}
		mysqli_close($DBConnection);

		if ($UserValid == 1) //Successful login.
		{
			echo'<script>$("#LoginForm").slideUp();</script>'; //slide the login form away using jQuery
			AccessBackEnd(); //ACCESS THE BACKEND FURTHER
		}
		else //Falied login.
		{
			echo "<p>You Have Failed Login Authentication.</p>" . $User . $Password;
		}
	}
	else //no details entered
	{
		echo "<p>Please input login details.</p>";
	}
	
	function AccessBackEnd()
	{
		//INSERT THE CODE TO LOAD YOUR PAGE
	}
?>
	</body>
</html>
