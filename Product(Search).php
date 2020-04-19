<?php
include("header.php");
?>
<html>
<head>
<?php
    if($_GET['Id'] == "e") echo"<title>Update Product</title>";
    elseif($_GET['Id'] == "d") echo"<title>Delete Product</title>";
    elseif($_GET['Id'] == "") echo "<title>Add Product</title>";
    elseif($_GET['Id'] == "sl") echo "<title>Set Product Low Stock Reminder</title>";
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
        font-size: 18px;
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
        while(list($key, $val) = each($_POST))	
        {
            if($key != "btnDelete" && $key != "chkAll")
            {
                echo $key."<br>";
                $DelSales = "DELETE FROM tblsalesorder WHERE orderId = '".$key."'";				

                $DelSalesResult = mysqli_query($Link,$DelSales);

                if($DelSalesResult)
                    echo "<script>alert('Record deleted');</script>";
                else echo "<script>alert('Record delete failed')";
            }
            else if($key == "chkAll")
            {
                $DelProdt = "DELETE FROM tblproduct";

                $DelProdtResult = mysqli_query($Link,$DelProdt);

                if($DelProdtResult)
                    echo "<script>alert('Record deleted');</script>";
                else echo "<script>alert('Record delete failed');</script>";
            }
        }
    }
    else if($_POST['btnSearch'])
    {
        echo "<input type='button' name='btnBack' value='Back' style='margin-top:40px;margin-left:100px;padding:7px;' onClick='window.history.back()'/>";
        
        $SQL = "SELECT * FROM tblproduct WHERE ";
        //$SQL = "SELECT tblproduct.*,tblprodstat.qty,tblprodstat.unitPrice FROM tblproduct,tblprodstat WHERE tblproduct.productId = tblprodstat.pId AND ";
        if(trim($_POST['sltId']) != "")
            $SQL .= "tblproduct.productId LIKE '%".strtoupper(trim($_POST['sltPId']))."%' AND ";	

        if(trim($_POST['txtName']) != "")
            $SQL .= "tblproduct.productName LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";	

        if(trim($_POST['sltCat']) != "")
            $SQL .= "tblproduct.category= '".strtoupper(trim($_POST['sltCat']))."' 
            AND ";					
        $SQL .= "ORDER BY productName";
        $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
        $SQL = str_replace("AND ORDER", "ORDER", $SQL);
        //echo $SQL;
        $Result = mysqli_query($Link,$SQL);
        if(mysqli_num_rows($Result) > 0)
        {

            if($_GET['Id'] == "d")
            ?>
            <!--<div id="bottomDiv" class="animate-bottom">-->
            <form name="" method="post" action="">
            <table id="myForm" name="myForm" align="center" width="1000px" border="1">
              <tr height="60px" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;"><th colspan="7" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;"><center>Product Info Result</center></th></tr>
              <tr>
                    <td>No</td>
                    <?php
                    if($_GET['Id'] == "d")
                    echo "<td><input type=\"checkbox\" name=\"".$row['productId']."\"></td>";
                    ?>
                    <td>Product Name</td>
                    <td>Product Id</td>
                    <td>Category</td>
                    <!--<td>Quantity</td>
                    <td>Unit Price</td>-->
                </tr>
            <?php

            for($i = 0; $i < mysqli_num_rows($Result); $i++)
            {
                $row = mysqli_fetch_array($Result);

                if($_GET['Id'] == "e"){
                    //echo "<a href=\"Product.php?Id=".$row['productId']."\">";
                    echo "<tr>";
                    echo "<td><a href=\"Product.php?Id=".$row['productId']."\">".($i+1)."</a></td>";
                    echo "<td><a href=\"Product.php?Id=".$row['productId']."\">".$row['productName']."</a></td>";
                    echo "<td><a href=\"Product.php?Id=".$row['productId']."\">".$row['productId']."</a></td>";
                    echo "<td><a href=\"Product.php?Id=".$row['productId']."\">".$row['category']."</a></td>";
                    /*echo "<td>".$row['qty']."</td>";
                    echo "<td>".$row['unitPrice']."</td>";*/
                    echo "</tr>";
                    //echo"</a>";
                }
                elseif($_GET['Id'] == "sl"){
                    echo "<tr>";
                    echo "<td><a href=\"SetLowStk.php?PId=".$row['productId']."\">".($i+1)."</a></td>";
                    echo "<td><a href=\"SetLowStk.php?PId=".$row['productId']."\">".$row['productName']."</a></td>";
                    echo "<td><a href=\"SetLowStk.php?PId=".$row['productId']."\">".$row['productId']."</a></td>";
                    echo "<td><a href=\"SetLowStk.php?PId=".$row['productId']."\">".$row['category']."</a></td>";
                    echo "</tr>";
                }
                else{
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    if($_GET['Id'] == "d")
                    echo "<td><input type='checkbox' name='".$row['productId']."'></td>";
                    echo "<td>";
                    echo $row['productName'];
                    echo "</td>";
                    echo "<td>".$row['productId']."</td>";
                    echo "<td>".$row['category']."</td>";
                    echo "</tr>";
                }
            }     
        }
        else echo "<p><center><h1>No Record Found</h1></center></p>";
        ?>
        </table>
        <?php
        if(mysqli_num_rows($Result) > 0){
            if($_GET['Id'] == 'd')
                echo "<center><input type='submit' name='btnDelete' class='btn btn-danger' style='padding:10px;font-size:16px;margin-top:5px;margin-bottom:5px' value='Delete'></center>";   
        }
        if($_GET['Id'] == "d")
        ?>
        </form>
        <?php
    }
    else
    {
        ?>
        <form method="post" action="">
        <table width="500" height="292" border="0" align="center" style="margin-top:15px;margin-bottom:10px">
          <tbody>
            <tr><th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;"><center>Product Info Filter</center></th></tr>
            <tr>
              <td>Product Name :</td>
              <td><input type="text" name="txtName" id="txtName"></td>
            </tr>
            <tr>
                <td width="120">Product Id :</td>
                <td width="">
                    <select name="sltPId">
                        <option value=""></option>
                    <?php
                        $PIdSQL = "SELECT * FROM tblproduct ORDER BY productId";
                        $PIdSQLResult = mysqli_query($Link,$PIdSQL);
                        if(mysqli_num_rows($PIdSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                            {
                                $PIdRow = mysqli_fetch_array($PIdSQLResult);
                                echo "<option value='".$PIdRow['productId']."'"; 
                                echo " >".$PIdRow['productId']."</option>";
                            }
                        }
                        else echo "<option value=''>No Record Found</option>";
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>Category :</td>
                <td>
                    <select name="sltCat">
                        <option value=""></option>
                    <?php
                        $CatSQL = "SELECT * FROM tblcategory ORDER BY catName";
                        $CatSQLResult = mysqli_query($Link,$CatSQL);
                        if(mysqli_num_rows($CatSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($CatSQLResult); $i++)
                            {
                                $CatRow = mysqli_fetch_array($CatSQLResult);
                                echo "<option value='".$CatRow['catId']."'"; 
                                echo " >".$CatRow['catName']."</option>";
                            }
                        }
                        else echo "<option value=''>No Record Found</option>";
                    ?>
                </select></td>
            </tr>
            <tr>
            <td colspan="2" align="center">
        <?php
            echo "<input name='btnSearch' class='btn btn-primary' type='submit' id='btnSearch' style='padding:10px;font-size:16px' value='Search' />";
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
    <!--</div>-->
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