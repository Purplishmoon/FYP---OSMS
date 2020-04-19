<?php
include("header.php");
?>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="AlertMessage.css" rel="stylesheet" type="text/css">
<?php
    if(Id == "e") echo"<title>Update Sales Order</title>";
    elseif(Id == "d") echo"<title>Delete Sales Order</title>";
    elseif(Id == "") echo "<title>View Sales Order</title>";
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
</style>
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
                $DelSales = "DELETE FROM tblsalesorder WHERE orderId = '".$key."'";		

                $DelSalesItem = "DELETE FROM tblsalesorderitem WHERE orderId = '".$key."'";		

                $DelSalesResult = mysqli_query($Link,$DelSales);
                $DelSalesItemResult = mysqli_query($Link,$DelSalesItem);

                if($DelSalesResult )
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Sales order info deleted.");
                    //echo "<script>alert('Record deleted');</script>";
                else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Sales order info delete failed.");
                    //echo "<script>alert('Record delete failed')";
            }
            else if($key == "chkAll")
            {
                $DelProdt = "DELETE FROM tblsalesorder";

                $DelSalesResult = mysqli_query($Link,$DelSales);

                if($DelSalesResult)
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Sales order info deleted.");
                    //echo "<script>alert('Record deleted');</script>";
                else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Sales order info delete failed.");
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
     echo "<input type='button' name='btnBack' value='Back' style='margin-top:12px;margin-left:280px;padding:7px' onClick='window.history.back()'><br>";
      
        $SQL = "SELECT * FROM tblsalesorder WHERE ";

        if(trim($_POST['txtId']) != "")
            $SQL .= "tblsalesorder.orderId LIKE '%".strtoupper(trim($_POST['txtId']))."%' AND ";	

        if(trim($_POST['txtName']) != "")
            $SQL .= "tblsalesorder.custId LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";	

        if(trim($_POST['txtDate']) != "")
            $SQL .= "tblsalesorder.date= '".strtoupper(trim($_POST['txtDate']))."' AND ";	


        $SQL .= "ORDER BY orderId DESC";
        $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
        $SQL = str_replace("AND ORDER", "ORDER", $SQL);
        //echo $SQL;
        $Result = mysqli_query($Link,$SQL);
        if(mysqli_num_rows($Result) > 0)
        {
            if($_GET['Id'] == "d")
            ?>
            <form name="" method="post" action="">
                <a href="Product(Search).php"><input type="button" name="btnBack" value="Back"></a>
            <table width="500" border="1" style="margin-top:15px;margin-bottom:10px">
                <tr><th colspan="6" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Sales Order Info Result</center></th></tr>
                <tr>
                    <td>No</td>
                    <?php
                    if($_GET['Id'] == "d")
                    echo "<td><input type=\"checkbox\" name=\"".$row['orderId']."\"></td>";
                    ?>
                    <td>Order Id</td>
                    <td>Customer Name</td>
                    <td>Date</td>
                    <td>Total Amount</td>
                </tr>
            <?php

            for($i = 0; $i < mysqli_num_rows($Result); $i++)
            {
                $row = mysqli_fetch_array($Result);

                if($_GET['Id'] == 'e'){
                    //echo "<a href=\"Sales Order.php?Id=".$row['orderId']."\">";
                    echo "<tr>";
                    echo "<td><a href=\"Sales Order v2.php?Id=".$row['orderId']."\">".($i+1)."</a></td>";
                    //echo "<td><input type=\"checkbox\" name=\"".$row['productId']."\"></td>";
                    echo "<td><a href=\"Sales Order v2.php?Id=".$row['orderId']."\">".$row['orderId']."</a></td>";
                    echo "<td><a href=\"Sales Order v2.php?Id=".$row['orderId']."\">".$row['custName']."</a></td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['totalAmt']."</td>";
                    echo "</tr>";
                    //echo"</a>";
                }
                else{
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    if($_GET['Id'] == "d")
                      echo "<td><input type=\"checkbox\" name=\"".$row['orderId']."\"></td>";
                    echo "<td>".$row['orderId']."</td>";
                    echo "<td>".$row['custId']."</td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['totalAmt']."</td>";
                    echo "</tr>";
                }
            }
        }
        else "<p><center><h1>No Record Found</h1></center></p>";
        if($_GET['Id'] == 'd')
            echo "<tr><td colspan=\"6\"><input type=\"submit\" name=\"btnDelete\" value=\"Delete\"></td></tr>";
        ?>
        </table>
        <?php
        if($_GET['Id'] == "d")
        ?>
        </form>
        <?php
    }    
    else
    {
    ?>
    <div id="bottomDiv" class="animate-bottom">
      <form id="myForm" name="myForm" method="post" action="">
        <table width="500" height="292" border="1" align="center">
          <tbody>
            <tr>
              <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Sales Order Info Filter</center></th>
            </tr>
            <tr>
                <td width="100">Sales Order Id:</td>
                <td width="300">
                    <input type="text" name="txtId"></td>
            </tr>
            <tr>
                <td>Customer Name:</td>
                <td>
                <input type="text" name="txtName"></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td>
                <input type="date" name="txtDate"></</td>
            </tr>
            <!--<tr>
                <td>Total Amount:</td>
                <td>
                <input type="text" name="txtTotalAmt"></</td>
            </tr>-->
            <tr>
                <td colspan="2" align="center">
            <?php
            //if($_GET['Id'] != "")
                echo "<input name=\"btnSearch\" type=\"submit\" id=\"btnSearch\" value=\"Search\" />";
            ?>
                </td>
            </tr>
          </tbody>
        </table>
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
</body>
</html>