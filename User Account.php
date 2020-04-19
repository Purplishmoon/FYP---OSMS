<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<?php
		if(Id != "") echo "<title>Update User Account</title>";
		else echo "<title>Add User Account</title>";
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
         /* text-align: center;
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
	<script>
	function Reset(){
		document.getElementById("myForm").reset();
	}
	</script>
</head>
<body bgcolor="">
<?php
    if($_SESSION['LoginStatus'] == true){
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
				if($_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['sltAccType'] == "" || $_POST['sltStatus'] == "")
				{
					echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
                    $UpdateUsr = "UPDATE tbluseraccount SET userName = '".strtoupper(trim($_POST['txtName']))."',
							accType = '".strtoupper(trim($_POST['sltAccType']))."',
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
        else if($_POST['btnAdd'])
        {
                if($_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['sltAccType'] == "" || $_POST['txtPassword'] == "" || $_POST['txtRePass'] == "")	
                {
                    echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
                }
                else
                {
                    $AddUsrSQL = "INSERT INTO tbluseraccount (userId,userName,accType,password,status) 
                    VALUES ('".strtoupper(trim($_POST['txtId']))."',
                    '".strtoupper(trim($_POST['txtName']))."',
                    '".strtoupper(trim($_POST['sltAccType']))."',
                    '".md5(trim($_POST['txtPassword']))."',
                    'A')";

                    $AddUsrResult = mysqli_query($Link,$AddUsrSQL);
					
					if($AddUsrResult)
                    {
                        echo "<script>alert('Record added successfully'); location='User Account.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Record added failure'); location='$PHP_SELF';</script>";
                    }
                }
			}
        
?>
    <div id="bottomDiv" class="animate-bottom">
      <?php
         echo "<input type='button' name='btnBack' value='Back' style='margin-top:12px;margin-left:240px;padding:7px' onClick='window.history.back()'><br><br>";
      ?>
    <form name="myForm" action="" method="post">
        <table align="center" border="0" width="400px" height="400px" style="margin-top:15px;margin-bottom:10px">
          <tr>
                <th style="background-color:cornflowerblue;
          font-size:20px;
          color:azure;" colspan="2"><center>User Info</center></th>
            </tr>
          <tr>
              <td align="left">User Id :</td>
              <td>
                  <input type="text" name="txtId" value="<?php if($_GET['Id'] != "") echo $row['userId']; ?>"<?php if($_GET['Id'] != "") echo " readonly"; ?> required>
                  <!--<select name="sltId" <?php //if($_GET['Id'] != "") echo " readonly"; ?> required>
                      <option value="">Please select Id</option>-->
              <?php          
                  //Create temporary table tId to store custId & empId 
                  /*$CreateTempTblSQL = "CREATE TABLE tblid(Id VARCHAR(14))";
                  $TempTblPutCIdSQL = "INSERT INTO tblid SELECT custId FROM tblcustomer";
                  $TempTblPutEIdSQL = "INSERT INTO tblid SELECT empId FROM tblemployee";
                  $IdSQL = "SELECT Id FROM tblid ORDER BY Id ASC";  //Read Id from temporary table tId

                  $CreateTempTblSQLResult = mysqli_query($Link,$CreateTempTblSQL);
                  $TempTblPutCIdSQLResult = mysqli_query($Link,$TempTblPutCIdSQL);
                  $TempTblPutEIdSQLResult = mysqli_query($Link,$TempTblPutEIdSQL);
                  $IdSQLResult = mysqli_query($Link,$IdSQL);

                  if(mysqli_num_rows($IdSQLResult) > 0){
                      for($i = 0; $i < mysqli_num_rows($IdSQLResult); $i++)
                      {
                          $IdRow = mysqli_fetch_array($IdSQLResult);
                          echo "<option value='".$IdRow['Id']."'"; 
                          if($row['userId'] == $IdRow['Id']) echo " selected readonly";
                          echo " >".$IdRow['Id']."</option>";
                      }
                  }
                  else echo "<option value=''>No Record Found</option>";

                  //Drop temporary table tId from database
                  $DropTempTblSQL = "DROP TABLE tblid";
                  $DropTempTblSQLResult = mysqli_query($Link,$DropTempTblSQL);*/
              ?>
                  </select>
              </td>
          </tr>
          <tr>
              <td align="left">Username :</td>
              <td><input type="text" name="txtName" value="<?php if($_GET['Id'] != "") echo $row['userName']; ?>" required></td>
          </tr>
          <tr>
              <td align="left">Account Type :</td>
              <td><select name="sltAccType" required>
                  <option value="">Please select option</option>
                  <option value="ADMIN" <?php if($row['accType'] =="ADMIN") echo "selected='selected'"; ?>>Admin</option>
                  <option value="CUST" <?php if($row['accType'] =="CUST") echo "selected='selected'"; ?>>Customer</option>
                  <option value="EMP" <?php if($row['accType'] =="EMP") echo "selected='selected'"; ?>>Employee</option>
                  </select>
              </td>
          </tr>
    <?php
        if($_GET['Id'] == "")
          echo "<tr>
                  <td align='left'>Password : </td>
                  <td>
                      <input type='password' id='password' name='txtPassword' minLength=8 pattern='' title='Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' required />
                  </td>
                </tr>
                <tr>
                  <td align='left'>Retype Password :</td>
                  <td>
                       <input type='password' id='confirm_password' name='txtRePass' minLength=8 oninput='validatePassword()' required>
                  </td>
                </tr>";
        elseif($_GET['Id'] == $_SESSION['UserId']) 
          echo "<tr>
                  <td align='left'>Password : </td>
                  <td align='left'>
                      <a href='Update Password v2.php?Id=".$row['userId']."'><input type='button' name='btnEditPass' style='font-size:16px;padding:7px;' value='Change Password'></a>
                  </td>
                </tr>";
     ?>
          <!--<tr>
              <td align="left">Status :</td>
              <td><select name="sltStatus">
                  <option value="">Please select option</option>
                  <option  <?php //if($row['state'] =="A") echo "selected='selected'"; ?>>Active</option>
                  <option  <?php //if($row['state'] =="I") echo "selected='selected'"; ?>>Inactive</option>
                  </select></td>
          </tr>-->
      <?php
          if($_GET['Id'] != "") 
          {
              echo "<tr>";
              echo "<td><label>Status: </label></td>";
              echo "<td><select name='sltStatus' size='2' scroll='none'>";
              echo "<option value='A'"; if($row['status'] == "A") echo " selected"; 
              echo ">Active</option>";
              echo "<option value='I'"; if($row['status'] == "I") echo " selected"; 
              echo ">Inactive</option>";
              echo "</select></td>";       
              echo "</tr>";
          }
      ?>
          <tr>
              <td colspan=7 align="center" style="border:0px">
                  <?php
                  if($_GET['Id'] != "")
                      echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Confirm' style='margin:5px;padding:5px'>";
                  elseif($_GET['Id'] == "")
                      echo "<input type='submit' class='btn btn-primary' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";
                  ?>
                  <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
          </tr>
        </table>
    </form>
    </div>
<?php	
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
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</body>
</html>