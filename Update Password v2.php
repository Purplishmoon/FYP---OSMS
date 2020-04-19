<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Change Password</title>
  <?php
   $userId = $_GET['Id'];
   $key = false;
  ?>
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <style>
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
            display: /*none*/;
          /*  text-align: center;
          }*/
    
      th{
          background-color: cornflowerblue;
          font-size: 20px;
          color: azure;
      }
      td .border{
          border: 2px solid dimgrey;
      }
      td{
          font-size: 18px
      }
  </style>
  <script type="text/javascript">
    //Password verification
    /*function promptPass(){
      var flag = 0;
      var scan = 0;
      var key = 0;
      var pass;
      while(flag == 0){
        <?php
        //echo "prompt('Please enter your password:','');";
        ?>
        pass = prompt('Please enter your password:','');  //Error: If click Cancel still appear cofirm box
        document.getElementById('myPass').value = pass;
        //if(pass != false){
          if(pass == "" | pass == null){
            var con = confirm('Password invalid. Want to retype?');
            if(con != true){
              flag = 1;
              scan = 0;
              key = 0;
            }
            else {
              flag = 0;
              scan = 0;
              key = 0;
            }
          }
          else scan = 1;
        //}
        //else flag = 1;        
        <?php
            /*if($_GET['scan'] == 1){
                $PassSQL = "SELECT password FROM tbluseraccount WHERE userId = '".$userId."'";

                $PassResult = mysqli_query($Link,$PassSQL);
                if($PassResult){
                  $row = mysqli_fetch_array($PassResult);
                  if($row['password'] == md5($_GET['pass'])){
                ?> key = 1; <?php
                  }
                  else {
                ?> key = 0; <?php
                }
            }
          }*/
        ?>

        if(scan == 1){*/
      <?php
          //$pass = "document.writeln(pass);";  //bottleneck get pass from javascript
          
          //ajax function to pass JavaScript variable to hidden
          ?>
  </script>
  <script src="/js/jquery-3.2.1.min.js">
    /*var userdata = {'myPass':pass};
    $.ajax({
            type: "POST",
            url: "http://localhost/php/FYP%20-%20OSMS/Update%20Password.php?Id=".$userId,
            data:userdata, 
            success: function(data){
                console.log(data);
            }
            });

    var myvalue = 55;
    $("#myPass").val(myvalue);*/
  </script>
      <?php
          /*$pass = trim($pass);
          $PassSQL = "SELECT password FROM tbluseraccount WHERE password = '".$pass."'";
          echo "<script>alert('".$pass."');</script>";
          $PassResult = mysqli_query($Link,$PassSQL);
          if(mysqli_num_rows($PassResult) > 0){
            $row = mysqli_fetch_array($PassResult);
            if($row['password'] == md5(trim($pass))) {  ?>
              flag = 1;
              key = 1;
      <?php } 
            else {  ?>
               con = confirm('Password invalid. Want to retype?');
              if(con != true){
                flag = 1;
                scan = 0;
                key = 0;
              }
              else {
                flag = 0;
                scan = 0;
                key = 0;
              }
          <?php
            }
          }*/
      ?>
  <script type="text/javascript">
        /*}    
      }
      if(key == 0) location = "User Account.php?Id=<?php //echo $userId; ?>";
    }*/
	</script>
</head>
<body onload="" bgcolor="">
<?php
    if($_SESSION['LoginStatus'] == true){
      //echo "<script>promptPass().call;</script>";
       //if($_GET['key'] == 1){
      //echo "<script>var pass = prompt('Please enter your password:','');</script>";
        echo "<div id='topDiv' class='animate-top'>";
        include("menu.php");
        echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
        echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
        echo "</div></div>";
      
      if($_POST['btnVerify']){
        if($_POST['txtPassV'] == ""){
          echo "<script>showLabel();</script>";
        }
        else{
          $PassSQL = "SELECT password FROM tbluseraccount WHERE password = '".md5(trim($_POST['txtPassV']))."'";
          $PassResult = mysqli_query($Link,$PassSQL);
          if(mysqli_num_rows($PassResult) > 0){
            $key = true;
          }
          else echo "<script>alert('Invalid Password!'); document.getElementById('myForm').reset();</script>";
        }
      }  
      if($_POST['btnUpdate'])
      {
        if($_POST['txtPassword'] == "" || $_POST['txtRePass'] == "")
        {
            echo "<script>alert('Please fill in all blank field');</script>";
        }
        else
        {
          $UpdatePass = "UPDATE tbluseraccount SET password = '".trim($_POST['txtPassword'])."',     
                  WHERE userId = '".userId."'";

          $UpdatePassResult = mysqli_query($Link, $UpdatePass);

          if($UpdatePassResult)
          {
              echo "<script>alert('Record updated successfully'); location='User Account.php?Id=".$userId."';</script>";
          }
          else
          {
            echo "<script>alert('Record updated failure'); location = '".$PHP_SELF."'</script>";
          }
        }
      }
      else
      { ?>
        <input type="button" name="btnBack" value="Back" style="margin-top:12px;margin-left:280px;padding:7px" onClick="window.history.back()"><br>
       <form name="myForm" action="" method="post">
<?php   if($key == true){ ?>
    <div id="bottomDiv" class="animate-bottom">
      <input type="hidden" id="myPass">
      <div class="container">
        <table align="center" border="0" width="420px" height="400px" style="margin-top:15px;margin-bottom:10px">
          <tr>
              <th colspan="2" style="background-color:cornflowerblue;
        font-size:20px;color:azure;"><center>Change New Password</center></th>
          </tr>
          <tr>
              <td>Password :</td>
              <td>
                <input type="password" id="password" name="txtPassword" minLength=8 pattern="" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                <!--Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters-->
              </td>
          </tr>
          </tr>
          <tr>
              <td>Retype Password : </td>
              <td><input type='password' id='confirm_password' name='txtRePass' minLength=8 oninput="validatePassword()" required></td><!--validatePass(this)-->

          </tr>
          <tr>
            <td colspan=7 align="center" style="border:0px">
              <input type="submit" class='btn btn-primary' name="btnUpdate" value="Confirm" style="margin:5px;padding:5px">            
              <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
        </tr>
        </table>
       </div>
    </div>
  <?php
      }
      else
      {
        //Password Verification
        echo "<script>alert('Please enter your password.');</script>";
  ?>
    <div name="passValidation">
      <table align="center" border="0" width="300px" height="240px" style="margin-top:15px;margin-bottom:10px">
        <tr>
          <th colspan="2" style="background-color:cornflowerblue;
      font-size:20px;color:azure;"><center>Password Verification</center></th>
        </tr>
        <tr>
          <td>Password : </td>
          <td><input type='password' id='' name='txtPassV' value='' onkeydown="hideLabel()" required><br>
              <label id="lblPassV" for="txtPassV" style="display:none;"></label>
          </td>
        </tr>
        <tr>
            <td colspan=7 align="center" style="border:0px">
              <input type="submit" name="btnVerify" value="Verifify" style="margin:5px;padding:5px"> 
            </td>
        </tr>
      </table>
    </div>
<?php
     //}
        } ?>
      </form>
<?php }
    }
    else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>
<script>
  function hideLabel(){
    document.getElementById("lblPassV").style.display = "none";
  }
  
  function showLabel(){
    document.getElementById("lblPassV").style.display = "block";
  }
  
   //Password validation
  var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  }
  else {
    confirm_password.setCustomValidity('');
  }
}
  
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</body>
</html>