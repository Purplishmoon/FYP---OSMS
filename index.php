<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>OSMS Login</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="css/Login Style.css" />
</head>
<body bgcolor="">	
	<?php
	$_SESSION['LoginStatus'] = false;
	if($_GET['Id'] == "logout")
	{
		$_SESSION['LoginStatus'] = false;
	}
	if($_POST['btnLogin'])
	{	
		if($_POST['txtUsername'] == "" || $_POST['txtPass'] == "")	//empty field checking
		{
			echo "<script>alert('Please fill in your username and password');</script>";
		}
		else
		{
			//Verify username and password
            $SQL = "SELECT * FROM tbluseraccount WHERE userName = '".strtoupper($_POST['txtUsername'])."' AND password = '".md5(trim($_POST['txtPass']))."'";
            $LoginResult = mysqli_query($Link, $SQL);
            
			if(mysqli_num_rows($LoginResult) > 0)
			{	
				$row = mysqli_fetch_array($LoginResult);
				if($row['status'] == "I")
				{
					echo "<script>alert('Account is deactivated. Please contact your administrator : onlyone@email.com');</script>"; 
					//Access denied message
				}
				elseif($row['status'] == "A")
				{
                	$_SESSION['UserId'] = $row['userId'];
					$_SESSION['UserName'] = $row['userName'];
					$_SESSION['LoginStatus'] = true;
					$_SESSION['AccType'] = $row['accType'];
					
					echo "<script>location='homepage.php';</script>";
				}
			}
           /* else if(strtoupper($_POST['txtUsername']) == "ONLYONE" && $_POST['txtPass'] == "gl@ss3s")
            {
                $_SESSION['LoginStatus'] = true;
                $_SESSION['AccType'] = "ADMIN";
                //setcookie("LoginStatus", true, (time()+30));
                //setcookie("AccType", "SYS ADMIN", (time()+30));
                echo "<script>location='homepage.php';</script>";		
            }    */   
            else
            {
                echo "<script>alert('Account access denied.');</script>"; //Access denied message
            }
		}
	}
	?>
	
<form class="login-form" name="Login Form" action="" method="post">
  <p class="login-text">
    <span class="">
	  OSMS
	</span>
  </p>
  <input type="text" name="txtUsername" class="login-username" autofocus="true" required="true" placeholder="Username" />
  <input type="password" name="txtPass" class="login-password" required="true" placeholder="Password" />
  <input type="submit" name="btnLogin" value="Login" class="login-submit" />
  <!--<a class="login-forgot-pass" href="">New to here?</a>-->
</form>
<div class="underlay-photo"></div>	
<div class="underlay-black"></div> 
</body>
</html>
