<?php
include("header.php");
?>
<html>
<head>
<?php
    if(Id == "e") echo"<title>Search Customer Prescription</title>";
    elseif(Id == "") echo "<title>Search Customer Prescription</title>";
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
    
    /*if($_POST['btnDelete'])
    {
        while(list($key, $val) = each($_POST))	
        {
            if($key != "btnDelete" && $key != "chkAll")
            {
                echo $key."<br>";
                $DelCust = "DELETE FROM tblcustomer WHERE custId = '".$key."'";		
                $DelCustResult = mysqli_query($Link,$DelCust);

                if($DelCustResult)
                    echo "<script>alert('Record deleted');</script>";
                else echo "<script>alert('Record delete failed')";
            }
            else if($key == "chkAll")
            {
                $DelCust = "DELETE FROM tblcustomer";

                if($DelCustResult)
                    echo "<script>alert('Record deleted');</script>";
                else echo "<script>alert('Record delete failed');</script>";
            }
        }
    }
    else*/ if($_POST['btnSearch'])
    {
        $CIdSQL = "SELECT tblcustomer.custName,tblpowerprescription.* FROM tblcustomer,tblpowerprescription WHERE tblpowerprescription.custId = tblcustomer.custId AND ";

        if(trim($_POST['txtName']) != "")
            $SQL .= "tblcustomer.custName LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";	

        if(trim($_POST['txtCId']) != "")
            $SQL .= "tblcustomer.custId = '".trim($_POST['txtCId'])."' AND ";	

        if(trim($_POST['txtId']) != "")
            $SQL .= "tblcustomer.phyId = '".trim($_POST['txtId'])."' AND ";	

        $CIdSQL .= "ORDER BY custName ASC";
        $CIdSQL = str_replace("WHERE ORDER", "ORDER", $CIdSQL);
        $CIdSQL = str_replace("AND ORDER", "ORDER", $CIdSQL);
        //echo $CIdSQL;
        $CIdResult = mysqli_query($Link,$CIdSQL);
      
        //$VIdSQL = "SELECT # FROM tblpowerprescription WHERE ";

        if(mysqli_num_rows($CIdResult) > 0)
        {
            ?>
            <table name="myForm" id="myForm" width="800px" border="1" align="center" style="margin-top:15px;">
              <tr height="60px"><th style="background-color:cornflowerblue;font-size:20px;color:azure;" colspan="6"><center>Customer Prescription Info Result</center></th></tr>
              <tr>
                  <td>No</td>  
                  <td>Prescription Id :</td>
                  <td>Customer Name :</td>
                  <td>Customer Id :</td>
                  <td>Date</td>
              </tr>
            <?php

            for($i = 0; $i < mysqli_num_rows($CIdResult); $i++)
            {
                $row = mysqli_fetch_array($CIdResult);

                if($_GET['Id'] == 'e'){
                    echo "<tr>";
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."&VId=".$row['vId']."\">".($i+1)."</a></td>";
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."&VId=".$row['vId']."\">".$row['vId']."</a></td>";
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."&VId=".$row['vId']."\">".ucwords(strtolower($row['custName']))."</a></td>";
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."&VId=".$row['vId']."\">".$row['custId']."</a></td>";
                  if($row['createdBy'] != "N.A"){
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."\">".$row['date']."</a></td>";
                  }
                  else{
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."\">Not Record</a></td>";
                  }
                    echo "</tr>";
                }
                else{
                    echo "<tr>";
                    echo "<td><a href=\"PowerPrescription.php?CId=".$row['custId']."&VId=".$row['vId']."\">".($i+1)."</a></td>";
                    echo "<td><a href=\"PowerPrescription.php?CId=".$row['custId']."&VId=".$row['vId']."\">".$row['vId']."</a></td>";
                    echo "<td><a href=\"PowerPrescription.php?CId=".$row['custId']."&VId=".$row['vId']."\">".ucwords(strtolower($row['custName']))."</a></td>";
                    echo "<td><a href=\"PowerPrescription.php?CId=".$row['custId']."&VId=".$row['vId']."\">".$row['custId']."</a></td>";
                  if($row['createdBy'] != "N.A"){
                    echo "<td><a href=\"PowerPrescription.php?Id=".$row['custId']."\">".$row['date']."</a></td>";
                  }
                  else{
                    echo "<td><a href=\"PowerPrescription.php?Id=e&CId=".$row['custId']."\">Not Record</a></td>";
                  }
                    echo "</tr>";
                }
            }
        }
        else echo "<p><center><h1>No Record Found</h1></center></p>";
        if($_GET['Id'] == 'd')
            echo "<tr><td colspan='6'><input type='submit' name='btnDelete' value='Delete'></td></tr>";
    ?>
        </table>
    <center>
    <?php
        echo "<input type='button' name='btnBack' class='btn btn-outline-primary' value='Back' style='margin:10px;' onClick='window.history.back()' padding='10px'>";
    ?>
    </center>
        <!--</form>-->
        <?php
    }
    else
    {
        ?>
    <div id="bottomDiv" class="animate-bottom">
        <form method="post" action="">
        <table width="600" height="280" border="0px" align="center" style="margin-top:20px">
        <tbody>
        <tr><th style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;" colspan="2"><center>Customer Info Filter</center></th></tr>
        <tr>
            <td width="140px">Customer Id:</td>
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
                <input name="btnSearch" type="submit" id="btnSearch" value="Search" />
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