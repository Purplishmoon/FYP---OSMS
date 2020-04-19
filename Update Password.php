<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Change Password</title>
  <?php
      //if(Id == "") echo "<title>Change Password</title>";
      //elseif(Id //== "e") echo "<title>Update User Account</title>";
      //else echo "<title>View User Account</title>";
   $userId = $_GET['Id'];
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
    function promptPass(){
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

        if(scan == 1){
      <?php
          //$pass = "document.writeln(pass);";  //bottleneck get pass from javascript
          
          //ajax function to pass JavaScript variable to hidden
          ?>
  </script>
        <script src="/js/jquery-3.2.1.min.js">
          var userdata = {'myPass':pass};
          $.ajax({
                  type: "POST",
                  url: "http://localhost/php/FYP%20-%20OSMS/Update%20Password.php?Id=".$userId,
                  data:userdata, 
                  success: function(data){
                      console.log(data);
                  }
                  });
          
          var myvalue = 55;
          $("#myPass").val(myvalue);
        </script>
      <?php
          $pass = trim($pass);
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
          }
      ?>
  <script type="text/javascript">
        }    
      }
      if(key == 0) location = "User Account.php?Id=<?php echo $userId; ?>";
    }
	</script>
</head>
<body onload="" bgcolor="">
<?php
    if($_SESSION['LoginStatus'] == true){
      echo "<script>promptPass().call;</script>";
       if($_GET['key'] == 1){
      //echo "<script>var pass = prompt('Please enter your password:','');</script>";
        echo "<div id='topDiv' class='animate-top'>";
        include("menu.php");
        echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
        echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
        echo "</div></div>";
        
        if($_GET['Id'] != "")
        {
          $SQL = "SELECT * FROM tbluseraccount WHERE userId = '".$_GET['Id']."'";
          $Result = mysqli_query($Link,$SQL);
          if(mysqli_num_rows($Result) > 0)
              $row = mysqli_fetch_array($Result);
        }
        if($_POST['btnUpdate'])
        {
          if($_POST['txtPassword'] == "" || 
             $_POST['txtRePass'] == "")
          {
              echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
          }
          else
          {
                echo $UpdatePass = "UPDATE tbluseraccount SET password = '".trim($_POST['txtPassword'])."',
                        accType = '".strtoupper(trim($_POST['sltAccType']))."',
                        password = '".md5(trim($_POST['txtPassword']))."',
                        status = '".strtoupper(trim($_POST['sltStatus']))."'
                        WHERE userId = '".trim($_POST['txtId'])."'";


                $UpdateUsrResult = mysqli_query($Link, $UpdateUsr);

                if($UpdateUsrResult)
                {
                    echo "<script>alert('Record updated successfully'); location='User Account.php';</script>";
                }
                else
                {
                    echo "<script>alert('Record updated failure'); location='$PHP_SELF';</script>";
                }
            }
        }    
?>
    <div id="bottomDiv" class="animate-bottom">
    <form name="myForm" action="" method="post">
        <input type="hidden" id="myPass"s>
            <table align="center" border="0" width="400px" height="400px" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Change New Password</center></th>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" id='password' name="txtPassword" value="" required /></td>
                </tr>
                </tr>
                <tr>
                    <td>Password : </td>
                    <td>
                       <input type='password' id='password' name='txtPassword' value='' required>
                    </td>
                </tr>
			
                <tr>
                    <td colspan=7 align="center" style="border:0px">
                      <input type="submit" name="btnUpdate" value="Update" style="margin:5px;padding:5px">            
                      <input type="reset" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
                </tr>
            </table>
        </form>
    </div>
<?php
     }
    }
    else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>
<script>
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
</script>
</body>
</html>