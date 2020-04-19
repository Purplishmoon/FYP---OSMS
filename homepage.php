<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>OSMS  Home</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="AlertMessage.css" rel="stylesheet" type="text/css">
<style>
	/* Center the loader */
	/*#loader {
	  position: absolute;
	  left: 50%;
	  top: 50%;
	  z-index: 1;
	  width: 150px;
	  height: 150px;
	  margin: -75px 0 0 -75px;
	  border: 16px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 16px solid #3498db;
	  width: 120px;
	  height: 120px;
	  -webkit-animation: spin 2s linear infinite;
	  animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}*/

	/* Add animation to "page content" */
	/*.animate-bottom {
	  position: relative;
	  -webkit-animation-name: animatebottom;
	  -webkit-animation-duration: 1s;
	  animation-name: animatebottom;
	  animation-duration: 1s
	}*/

	.animate-top {
	  position: relative;
	  -webkit-animation-name: animatetop;
	  -webkit-animation-duration: 1s;
	  animation-name: animatetop;
	  animation-duration: 1s
	}
	
	@-webkit-keyframes animatetop {
	  from { top:-100px; opacity:0 } 
	  to { top:0px; opacity:1 }
	}

	@keyframes animatetop { 
	  from{ top:-100px; opacity:0 } 
	  to{ top:0px; opacity:1 }
	}

	/*@-webkit-keyframes animatebottom {
	  from { bottom:-100px; opacity:0 } 
	  to { bottom:0px; opacity:1 }
	}

	@keyframes animatebottom { 
	  from{ bottom:-100px; opacity:0 } 
	  to{ bottom:0px; opacity:1 }
	}*/

	#topDiv {
	  display: /*none*/;
	  text-align: center;
	}
	
	/*#bottomDiv {
	  display: none;
	  /*text-align: center;
	}*/
</style>
</head>

<body style="margin:0;"><!-- onload="myFunction()"-->
<?php
	
	if($_SESSION['LoginStatus'] == true)
	{
?>		<!--Loader-->
		<!--<div id="loader"></div>-->
		<div id="topDiv" class="animate-top"><!--style="display:none;"-->
		<?php 
			include("menu.php"); 
			echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
			echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
			echo "</div>";
		?>
		</div>
		<div id="bottomDiv" class="animate-bottom" style="align:center;"><!--style="display:none;"-->
			<h1 style="margin-top:12px;margin-left:80px;">Welcome to OSMS</h1>
			<!--<img src="Resource/Background Logo.png" style="width:712px;height:406.67px;opacity:0.025" alt="">-->
		</div>
<?php
		/*echo "<div class='alert'>
		  <span class='closebtn' onclick='var div = this.parentElement;
			div.style.opacity = \"0\";
			setTimeout(function(){ div.style.display = \"none\"; }, 500);'>&times;</span>  
		  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
		</div>";	*/
	}
	else
	{
		echo "<script>alert('Please login first.');location='index.php';</script>";
	}
?>
<script>
$(document).ready(function() {
	//var myVar;

	/*function myFunction() {
	  myVar = setTimeout(showPage, 1000);
	}

	function showPage() {
	  document.getElementById("loader").style.display = "none";
	  document.getElementById("topDiv").style.display = "block";
	  document.getElementById("bottomDiv").style.display = "block";
	}*/
//$(".closebtn").click(function() {
/*$(".closebtn").onclick(function() {
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 500);
  });
}*/
</script>
<?php
	include("LStkReminder.php");
?>
</body>
</html>