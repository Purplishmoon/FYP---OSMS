
<?php
include("header.php");
?>
<html>
    <head>
	<?php
		if(Id == "d") echo "<title>Delete User Acount</title>";
		elseif(Id == "e") echo "<title>Update User Acount</title>";
		else echo "<title>View User Acount</title>";
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
      <script>
        function Reset(){
            document.getElementById("myForm").reset();
        }
        </script>
    </head>
    <body>
<?php
    if($_SESSION['LoginStatus'] == true)
    {
      //top section
      echo "<div id='topDiv' class='animate-top'>";
      include("menu.php");
      echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
      echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
      echo "</div></div>";
        
      if($_GET['Id'] != "" && $_GET['Id'] != "e")
      {
            $SQL = "SELECT * FROM tbluseraccount WHERE userId = '".$_GET['Id']."'";
            $Result = mysqli_query($Link,$SQL);
            if(mysqli_num_rows($Result) > 0)
                $row = mysqli_fetch_array($Result);
            //echo $SQL;
            //echo $_SESSION['UserId'];
?>
      <div id="bottomDiv" class="animate-bottom">
        <table width="500px" height="300px" border="0" align="center" style="align:center;margin-top:30px;margin-bottom:10px">
          <tbody>
            <tr><th style="background-color:cornflowerblue;font-size:20px;color:azure;" colspan="2"><center>User Info</center></th>
            </tr>    
            <tr>
              <td width="160px">User Id :</td>
              <td width="">             
                  <input type="text" name="txtId" placeholder="999999-99-9999" value="<?php echo $row['userId']; ?>" <?php if($_GET['Id'] != "") echo " readonly"; ?>>
            </td>
            </tr>
            <tr>
              <td>Username :</td>
              <td>
                  <input type="text" name="txtName" id="txtName" value="<?php if($_GET['Id'] != "") echo $row['userName']; ?>">
                </td>
            </tr>
            <tr>
                <td>Account Type :</td>
                <td id="AccType">
                <select name="sltAccType" id="sltAccType" disabled>
                  <option value=""></option>
                  <option value="ADMIM" <?php if($row['accType'] =="ADMIN") echo "selected='selected'"; ?>>Admin</option>
                <option value="CUSTOMER" <?php if($row['accType'] =="CUST") echo "selected='selected'"; ?>>Customer</option>
                  <option value="EMPLOYEE" <?php if($row['accType'] =="EMP") echo "selected='selected'"; ?>>Employee</option>
              </select>
                </td>
            </tr>
            <!--<tr>
              <td>Status :</td>
              <td id="Status">
                 <select name="sltStatus" id="sltStatus" disabled>
                      <option value=""></option>
                      <option value="A" <?php if($row['status'] == "A") echo " selected"; ?>>Active</option>
                      <option value="I" <?php if($row['status'] == "I") echo " selected"; ?>>Inactive</option>
                  </select>
                </td>
            </tr>-->
            <tr>
              <td colspan="2" align="center"><a href="User%20Account.php?Id=<?php echo $row['userId']; ?>"><input type="button" name="btnGoUpdate" style="padding:7px;" value="Update Info" ></a></td>
            </tr>
          </tbody>
        </table>
      </div>
<?php
      }
      else
      {
        if($_POST['btnDelete'])
        {
            while(list($key, $val) = each($_POST))	
            {
                if($key != "btnDelete" && $key != "chkAll")
                {
                    echo $key."<br>";
                    $DelUser = "DELETE FROM tbluseraccount WHERE userId = '".$key."'";				

                    $DelUserResult = mysqli_query($Link,$DelUser);

                    if($DelUserResult)
                        echo "<script>alert('Record deleted');</script>";
                    else echo "<script>alert('Record delete failed')";
                }
                else if($key == "chkAll")
                {
                    $DelUser = "DELETE FROM tbluseraccount";

                    if($DelUserResult)
                        echo "<script>alert('Record deleted');</script>";
                     else echo "<script>alert('Record delete failed');</script>";
                }
            }
        }
        else if($_POST['btnSearch'])
        {
            $SQL = "SELECT * FROM tbluseraccount WHERE ";

            if(trim($_POST['txtUId']) != "")
                $SQL .= "tbluseraccount.userId LIKE '%".trim($_POST['txtId'])."%' AND ";	

            if(trim($_POST['txtName']) != "")
                $SQL .= "tbluseraccount.userName LIKE '%".trim($_POST['txtName'])."%' AND ";	

            if(trim($_POST['sltAccType']) != "")
                $SQL .= "tbluseraccount.accType LIKE '%".strtoupper(trim($_POST['sltAccType']))."%' AND ";	

            if(trim($_POST['sltStatus']) != "")
                $SQL .= "tbluseraccount.status LIKE '%".strtoupper(trim($_POST['sltStatus']))."%' AND ";	

            $SQL .= "ORDER BY userName";
            $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
            $SQL = str_replace("AND ORDER", "ORDER", $SQL);

            $Result = mysqli_query($Link,$SQL);

            echo "<a href='User%20Account(Search).php'><input type='button' name='btnBack' value='Back' style='margin-top:20px;margin-left:80px;padding:10px'></a><br><br>";
            if(mysqli_num_rows($Result) > 0)
            {
                if($_GET['Id'] == "d")
                ?>
                <form name="" method="post" action="">
                <table width="500px" border="1" align="center" style="margin-top:20px">
                    <tr height="50px"><th style="background-color:cornflowerblue;font-size:20px;color:azure;" colspan="6"><center>User Account Result</center></th></tr>
                    <tr>
                        <td>No</td>
                        <?php
                        if($_GET['Id'] == "d")
                        echo "<td><input type='checkbox' name='".$row['userId']."'></td>";
                        ?>
                        <td>Username</td>
                        <td>User Id</td>
                        <!--<td>Gender</td>-->
                        <td>Type</td>
                        <td>Status</td>
                    </tr>
                <?php

                for($i = 0; $i < mysqli_num_rows($Result); $i++)
                {
                    $row = mysqli_fetch_array($Result);

                    if($_GET['Id'] == 'e'){
                        echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        //if($_GET['Id'] == "d")
                        //echo "<td><input type='checkbox' name='".$row['userId']."'></td>";
                        echo "<td><a href='User Account.php?Id=".$row['userId']."'>".$row['userName']."</a></td>";
                        //else if($_GET['Id'] == 'v' || $_GET['Id'] == 'd')
                          //echo $row['username'];
                        //echo "</td>";
                        echo "<td><a href='User Account.php?Id=".$row['userId']."'>".$row['userId']."</a></td>";
                        //echo "<td>".$row['gender']."</td>";
                        echo "<td>".$row['accType']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo"";
                    }
                    else
                    {
                        echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        if($_GET['Id'] == "d")
                        echo "<td><input type='checkbox' name='".$row['userId']."'></td>";
                        echo "<td>";
                        //if($_GET['Id'] == 'e')
                            //echo "<a href=\"User Account.php?Id=".$row['userId']."\">".$row['username']."</a>";
                        //else if($_GET['Id'] == 'v' || $_GET['Id'] == 'd')
                            echo $row['userName'];
                        echo "</td>";
                        echo "<td>".$row['userId']."</td>";
                        //echo "<td>".$row['gender']."</td>";
                        //echo "<td>".$row['city']."</td>";
                        echo "<td>".$row['accType']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "</tr>";
                    }

                    if($_GET['Id'] == 'd')
                        echo "<tr><td colspan='6'><input type='submit' name='btnDelete' value='Delete'></td></tr>";
                }
                ?>
                </table>
                <?php
                if($_GET['Id'] == "d")
                ?>
                </form>
                <?php
            }
            else echo "<p><center><h1>No Record Found</h1></center></p>";
        }
        else
        {
?>
        <div id="bottomDiv" class="animate-bottom">
          <form id="myForm" name="myForm" method="post" action="">
            <table width="500px" height="300px" border="0" align="center" style="align:center;margin-top:30px;margin-bottom:10px">
              <tbody>
                <tr><th colspan="2" style="background-color:cornflowerblue;
                font-size:20px;color:azure;"><center>User Info Filter</center></th>
                </tr>    
                <tr>
                  <td>Username :</td>
                  <td>
                  <input type="text" name="txtName" id="txtName"></td>
                </tr>
                <tr>
                  <td width="160px">User Id :</td>
                  <td width="">
                    <input type="text" name="txtUId" id="txtUId">
                    <!--<select name="sltUId">
                      <option value=""></option>
                  <?php
                  /*$UIdSQL = "SELECT userId FROM tbluseraccount";
                  $UIdSQLResult = mysqli_query($Link,$UIdSQL);
                  if(mysqli_num_rows($UIdSQLResult) > 0){
                      for($i = 0; $i < mysqli_num_rows($UIdSQLResult); $i++)
                      {
                          $UIdRow = mysqli_fetch_array($UIdSQLResult);
                          echo "<option value='".$UIdRow['custId']."'>".$UIdRow['userId']."</option>";
                      }
                  }
                  else echo "<option value=''>No Record Found</option>";*/
                      ?>
                  </select>-->
                  </td>
                </tr>
                <tr>
                  <td>Account Type :</td>
                  <td id="AccType">
                    <select name="sltAccType" id="sltAccType">
                      <option value=""></option>
                      <option value="ADMIM">Admin</option>
                    <option value="CUSTOMER">Customer</option>
                      <option value="EMPLOYEE">Employee</option>
                  </select></td>
                </tr>
                <tr>
                  <td>Status :</td>
                  <td id="Status">
                     <select name="sltStatus" id="sltStatus">
                          <option value=""></option>
                          <option value="A" selected>Active</option>
                          <option value="I">Inactive</option>
                      </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input name="btnSearch" type="submit" id="btnSearch" value="Search" />
                        <?php
                        //if($_GET['Id'] != "")
                            //echo "<input name=\"btnSearch\" type=\"submit\" id=\"btnSearch\" value=\"Search\" />";
                        //else if($_GET['Id'] == 'e')
                            //echo "<input name=\"btnEdit\" type=\"submit\"  id=\"btnEdit\" value=\"Search\" />";
                        //else if($_GET['Id'] == 'd')
                            //echo "<input type=\"submit\" name=\"btnDelete\" value=\"Search\" />";
                    ?>
                    </td>
                </tr>
              </tbody>
            </table>
          </form>
      </div>
<?php
        }
      }
	}
	else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>
</body>
</html>