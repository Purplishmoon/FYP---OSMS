<?php
include("header.php");
?>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="AlertMessage.css" rel="stylesheet" type="text/css">
<?php
    if(Id == "e") echo"<title>Update Employee</title>";
    elseif(Id == "d") echo"<title>Delete Employee</title>";
    elseif(Id == "") echo "<title>View Employee</title>";
?>
    
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
        table#myForm {
            border-collapse: collapse;   
        }
        #myForm tr {
            background-color: #eee;
            border-top: 1px solid #bbb;
        }
        #myForm tr:hover {
            background-color: #ccc;
        }
        #myForm th {
            /*background-color: #fff;*/
        }
        #myForm th, #myForm td {
            padding: 3px 5px;
        }
        #myForm td:hover {
            /*cursor: pointer;*/
        }
</style>
<script>
    function Reset(){
         document.getElementById("myForm").reset();
    }
</script>
    
<?php
if($_SESSION['LoginStatus'] == true)
{
    echo "<div id='topDiv' class='animate-top'>";
    include("menu.php");
    echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
    echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
    echo "</div></div>";
    
    if($_POST['btnDelete'])
    {
    ?>
        <script>
            var dChk = window.confirm('Are you sure to delete the selected data?');
            if(dChk == true){
        <?php
             while(list($key, $val) = each($_POST))	
            {
                if($key != "btnDelete" && $key != "chkAll")
                {
                    echo $key."<br>";
                    $DelEmp = "DELETE FROM tblemployee WHERE empId = '".$key."'";				

                    $DelEmpResult = mysqli_query($Link,$DelEmp);

                    if($DelEmpResult)
                        echo "<script>alert('Record deleted');</script>";
                    else echo "<script>alert('Record delete failed');</script>";
                }
                else if($key == "chkAll")
                {
                    $DelProdt = "DELETE FROM tblemployee";

                    $DelEmpResult = mysqli_query($Link,$DelEmp);

                    if($DelEmpResult)
                        echo "<script>alert('Record deleted');</script>";
                    else echo "<script>alert('Record delete failed');</script>";
                }
            }
        ?>
            }
            else <?php echo "location = '".$PHP_SELF."';"; ?>
        </script>
    <?php
    }
    if($_POST['btnSearch'])
    {
        $SQL = "SELECT * FROM tblemployee WHERE ";

        if(trim($_POST['txtEId']) != "")
            $SQL .= "tblemployee.empId LIKE '%".strtoupper(trim($_POST['txtEId']))."%' AND ";	
        
        if(trim($_POST['txtId']) != "")
            $SQL .= "tblemployee.phyId LIKE '%".strtoupper(trim($_POST['txtId']))."%' AND ";	

        if(trim($_POST['txtName']) != "")
            $SQL .= "tblemployee.empName LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";	
        if(trim($_POST['sltPos']) != "")
            $SQL .= "tblemployee.position = '".strtoupper(trim($_POST['sltPos']))."' AND ";

        $SQL .= "ORDER BY empName";
        $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
        $SQL = str_replace("AND ORDER", "ORDER", $SQL);
      
        $Result = mysqli_query($Link,$SQL);
        if(mysqli_num_rows($Result) > 0)
        {       
          if($_GET['Id'] == "d")
          ?>
          <form name="myForm" method="post" action="">
          <table name="myForm" id="myForm" align="center" width="700px" border="1" style="margin-top:20px;margin-bottom:10px">
            <tr height="60px" style="background-color:cornflowerblue;
                font-size:20px;
                color:azure;"><th colspan="6"><center>Employee Info Result</center></th></tr>
            <tr>
              <td>No</td>
              <?php
              if($_GET['Id'] == "d")
                echo "<td><input type=\"checkbox\" name=\"".$row['Id']."\"></td>";
              ?>
              <td width="260px">Employee Name</td>
              <td>Employee Id</td>
              <td>Physical Id</td>
              <td>Job Position</td>
            </tr>
          <?php
              for($i = 0; $i < mysqli_num_rows($Result); $i++)
              {
                $row = mysqli_fetch_array($Result);

                if($_GET['Id'] == 'e'){
                    //echo "<a href=\"Employee.php?Id=".$row['empId']."\">";
                    echo "<tr>";
                    echo "<td><a href=\"Employee.php?Id=".$row['empId']."\">".($i+1)."</a></td>";
                    echo "<td><a href=\"Employee.php?Id=".$row['empId']."\">".ucwords(strtolower($row['empName']))."</a></td>";
                    echo "<td><a href=\"Employee.php?Id=".$row['empId']."\">".$row['empId']."</a></td>";
                    echo "<td><a href=\"Employee.php?Id=".$row['empId']."\">".$row['phyId']."</a></td>";
                    echo "<td>".ucwords(strtolower($row['position']))."</td>";
                    echo "</tr>";
                    echo"</a>";
                }
                else{
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    if($_GET['Id'] == "d")
                      echo "<td><input type=\"checkbox\" name=\"".$row['empId']."\"></td>";
                    echo "<td>".ucwords(strtolower($row['empName']))."</td>";
                    echo "<td>".$row['empId']."</td>";
                    echo "<td>".$row['phyId']."</td>";
                    echo "<td>".ucwords(strtolower($row['position']))."</td>";
                    echo "</tr>";
                  }
              }
            //echo "<tr><td align='center' colspan=\"6\">";
              
            //echo "</td></tr>";
          }
          else echo "<p><center><h1>No Record Found</h1></center></p>";
          ?>
          </table>
          <center>
      <?php
            if($_GET['Id'] == 'd')
                echo "<input type=\"submit\" name=\"btnDelete\" class='btn btn-danger' style='padding:10px;font-size:16px;margin:5px' value=\"Delete\"></td>";
             echo "<input type='button' name='btnBack' class='btn btn-outline-primary' value='Back' align='center' style='padding:10px;font-size:16px;margin:5px' onclick='window.history.back();'>";
      ?>
          </center>
      <?php
          if($_GET['Id'] == "d")
          ?>
          </form>
<?php
    } 
    /*else
    {*/
?>
    <div id="bottomDiv" class="animate-bottom">
        <form id="" name="" method="post" action="">
            <table width="500px" height="292px" border="0" align="center" style="margin-top:50px">
            <tbody>
            <tr>
                <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;"><center>Employee Info Filter</center></th>    
            </tr>
            <tr>
                <td width="200px">Employee Name :</td>
                <td><input type="text" name="txtName" id="txtName"></td>
            </tr>
            <tr>
                <td width="px">Employee Id :</td>
                <td width="">
                    <input type="text" name="txtEId" id="txtEId">
                    <!--<select name="sltId">
                        <option value=""></option>
                    <?php
                        /*$EIdSQL = "SELECT empId FROM tblemployee";
                        $EIdSQLResult = mysqli_query($Link,$EIdSQL);
                        if(mysqli_num_rows($EIdSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($EIdSQLResult); $i++)
                            {
                                $EIdRow = mysqli_fetch_array($EIdSQLResult);
                                echo "<option value='".$EIdRow['empId']."'"; 
                                if($row['empId'] == $EIdRow['empId']) echo " selected";
                                echo " >".$EIdRow['empId']."</option>";
                            }
                        }
                        else echo "<option value=''>No Record Found</option>";*/
                    ?>
                    </select>-->
                </td>
            </tr>  
            <tr>
                <td width="px">Physical Id :</td>
                <td width="">
                    <input type="text" name="txtId" id="txtId">
                </td>
            </tr>  
            <tr>
                <td>Job position :</td>
                <td>
                    <select name="sltJobPos">
                        <option></option>
                        <option>Accountant</option>
                        <option>Cashier</option>
                        <option>Clerk</option>
                        <option>IT Support</option>     
                        <option>Manager</option>
                        <option>Optician</option>   
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
            <input name="btnSearch" type="submit" id="btnSearch" class="btn btn-primary" style="padding:10px;font-size:16px" value="Search" />
                </td>
            </tr>
          </tbody></table>
          </form>
    </div>
<?php
    //}
}
else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>
    <script>
        //JQuery table row click function
        $(document).ready(function() {

        $('#myForm tr').click(function() {
            var href = $(this).find("a").attr("href");
            if(href) {
                window.location = href;
            }
        });
    </script>
</body>
</html>