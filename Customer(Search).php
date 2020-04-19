<?php
include("header.php");
?>
<html>
<head>
<?php
    if(Id == "e") echo"<title>Update Customer</title>";
    elseif(Id == "d") echo"<title>Delete Customer</title>";
    elseif(Id == "") echo "<title>View Customer</title>";
?>    
<link href="style.css" rel="stylesheet" type="text/css">
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
            font-size: 18px;
        }
        table#myForm {
            border-collapse: collapse;   
        }
        #myForm tr {
            background-color: #eee;
            border-top: 1px solid #fff;
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
</script>
</head>
<body>

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
                    $DelCust = "DELETE FROM tblcustomer WHERE custId = '".$key."'";		
                    $DelCustResult = mysqli_query($Link,$DelCust);

                    if($DelCustResult)
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Customer info deleted.");
                        //echo "<script>alert('Record deleted');</script>";
                    else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Customer info delete failed.");
                        //echo "<script>alert('Record delete failed')";
                }
                else if($key == "chkAll")
                {
                    $DelCust = "DELETE FROM tblcustomer";
                    $DelCustResult = mysqli_query($Link,$DelCust);
                    if($DelCustResult)
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Customer info deleted.");
                        //echo "<script>alert('Record deleted');</script>";
                    else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Customer info delete failed.");
                        //echo "<script>alert('Record delete failed');</script>";
                }
            }
        ?>
            }
            else <?php echo "location = '".$PHP_SELF."';"; ?>
        </script>
<?php 
    }
    else if($_POST['btnSearch'])
    {
        $SQL = "SELECT * FROM tblcustomer WHERE ";

        if(trim($_POST['txtName']) != "")
            $SQL .= "tblcustomer.custName LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";

        if(trim($_POST['txtCId']) != "")
            $SQL .= "tblcustomer.custId = '".trim($_POST['txtCId'])."' AND ";	

        if(trim($_POST['txtId']) != "")
            $SQL .= "tblcustomer.phyId = '".trim($_POST['txtId'])."' AND ";	

        $SQL .= "ORDER BY custName ASC";
        $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
        $SQL = str_replace("AND ORDER", "ORDER", $SQL);
        //echo $SQL;
        $Result = mysqli_query($Link,$SQL);

        if(mysqli_num_rows($Result) > 0)
        {
            if($_GET['Id'] == "d")
            ?>
            <form name="" method="post" action="">
                <!--<a href="Customer(Search).php"><input type="button" name="btnBack" value="Back"></a>-->
            <table name="myForm" id="myForm" width="700px" border="1" align="center" style="margin-top:15px;">
              <tr height="60px"><th style="background-color:cornflowerblue;font-size:20px;color:azure;" colspan="6"><center>Customer Info Result</center></th></tr>
              <tr>
                  <td>No</td>
                  <?php
                  if($_GET['Id'] == "d")
                  echo "<td><input type=\"checkbox\" name=\"".$row['custId']."\"></td>";
                  ?>
                  <td>Customer Name :</td>
                  <td>Customer Id :</td>
                  <td>Phyical Id :</td>
              </tr>
            <?php

            for($i = 0; $i < mysqli_num_rows($Result); $i++)
            {
                $row = mysqli_fetch_array($Result);

                if($_GET['Id'] == 'e'){
                    //echo "<a href=\"Customer.php?Id=".$row['custId']."\">";
                    echo "<tr>";
                    echo "<td><a href=\"Customer.php?Id=".$row['custId']."\">".($i+1)."</a></td>";

                    echo "<td><a href=\"Customer.php?Id=".$row['custId']."\">".ucwords(strtolower($row['custName']))."</a></td>";

                    echo "<td><a href=\"Customer.php?Id=".$row['custId']."\">".$row['phyId']."</a></td>";

                    echo "<td><a href=\"Customer.php?Id=".$row['custId']."\">".$row['custId']."</a></td>";
                    echo "<td>".$row['phyId']."</td>";
                    //echo "<td>".$row['city']."</td>";
                    echo "</tr>";
                    //echo"</a>";
                }
                else{
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    if($_GET['Id'] == "d")
                    echo "<td><input type='checkbox' name='".$row['custId']."'></td>";
                    echo "<td>";
                        echo $row['custName'];
                    echo "</td>";
                    echo "<td>".$row['custId']."</td>";
                    echo "<td>".$row['phyId']."</td>";
                    //echo "<td>".$row['city']."</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
        else echo "<p><center><h1>No Record Found</h1></center></p>";
        ?>
        <center>
        <?php
         if($_GET['Id'] == 'd')
            echo "<input type='submit' name='btnDelete' class='btn btn-danger' style='margin:5px;padding:10px' value='Delete'>";
            echo "<input type='button' class='btn btn-outline-primary' name='btnBack' value='Back' style='margin:5px;padding:10px' onclick='window.history.back();'>";
        if($_GET['Id'] == "d")
        ?>
        </center>
        </form>
        <?php
    }
    else
    {
        ?>
    <div id="bottomDiv" class="animate-bottom">
        <form method="post" action="">
        <table width="300" height="280" border="0px" align="center" style="margin-top:20px">
        <tbody>
        <tr><th style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;" colspan="2"><center>Customer Info Filter</center></th></tr>
        <tr>
            <td width="150px">Customer Id:</td>
            <td width="150px">
                <input type="text" name="txtCId" size="20">
            </td>
        </tr>
        <tr>
           <td width="140px">Physical Id:</td>
           <td width="150px">
                <input type="text" name="txtId" size="20">
          </td>
        </tr>
        <tr>
            <td>Customer Name:</td>
            <td>
            <input type="text" name="txtName" id="txtName" size="20"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input name="btnSearch" type="submit" id="btnSearch" class="btn btn-primary" value="Search" />
            </td>
        </tr>
      </tbody></table>
      </form>
        <?php
        //SQL Success Message
        if(!empty($_SESSION['SUCCESS'])){
    ?>
            <div class="alert info">
              <span class="closebtn" onclick="var div = this.parentElement;
                div.style.opacity = '0';
                setTimeout(function(){ div.style.display = 'none'; }, 500);">&times;</span>  
              <strong><?php echo $_SESSION['SUCCESS'][0]; ?></strong> <?php echo $_SESSION['SUCCESS'][1]; ?></div>";
    <?php
            unset($_SESSION['SUCCESS']);
        }
        //SQL Warning Message
        if(!empty($_SESSION['WARN'])){
    ?>
            <div class="alert warning">
              <span class="closebtn" onclick="var div = this.parentElement;
                div.style.opacity = '0';
                setTimeout(function(){ div.style.display = 'none'; }, 500);">&times;</span>  
              <strong><?php echo $_SESSION['WARN'][0]; ?></strong> <?php echo $_SESSION['WARN'][1]; ?></div>";
    <?php
            unset($_SESSION['WARN']);
        }
        //SQL Error Message
        if(!empty($_SESSION['ERR'])){
    ?>
            <div class="alert">
              <span class="closebtn" onclick="var div = this.parentElement;
                div.style.opacity = '0';
                setTimeout(function(){ div.style.display = 'none'; }, 500);">&times;</span>  
              <strong><?php echo $_SESSION['ERR'][0]; ?></strong> <?php echo $_SESSION['ERR'][1]; ?></div>";
    <?php
            unset($_SESSION['ERR']);
        }
    ?>
    </div>
      <?php
		}
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