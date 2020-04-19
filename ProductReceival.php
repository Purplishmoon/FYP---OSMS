<?php
include("header.php");
?>
<html>
    <head>
<?php
    if(Id != "") echo"<title>Update Product Receival Record</title>";
    //elseif(Id == "d") echo"<title>Delete Product Receival Record</title>";
    elseif(Id == "") echo "<title>Add Product Receival Record</title>";
?>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="AlertMessage.css" rel="stylesheet" type="text/css">
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
    //Set time zone
    date_default_timezone_set('Asia/Kuala_Lumpur');
  
    if($_GET['Id'] != "")
    {
      //Set the Product quantity in Purchases Receival to status before received
      //Get first updated product quantity
      //Retrieve with for loop, select from tblprodstat with pId, $OldQty(qty) minus $OPStRow(qty) then update to tblprodstat, select all data from tblProdRev
      $OldPurRevSQL = "SELECT tblpurchasesreceived.productId,tblpurchasesreceived.qty FROM tblpurchasesreceived WHERE orderId = '".$_GET['Id']."' ORDER BY productId ASC";
      $OldPurRevResult = mysqli_query($Link,$OriPurRevSQL);
      //Retrieve data from tblpurchasesreceived
      $OldPRvQty = array();
      for($i = 0; $i < mysqli_num_rows($OldPurRevResult); $i++)
      {
        $OPRvRow = mysqli_fetch_array($OldPurRevResult);
        $OldPRvQty[] = $OPRvRow['qty'];
      }
        
      //Retrieve Product quantity
      $OldProdStatSQL = "SELECT qty FROM tblprodstat WHERE pId = '".$OPRvRow['productId']."' ORDER BY pId ASC";
      $OldProdStatResult = mysqli_query($Link,$OriProdStatSQL);
      
      $OldQty = array();
      for($j = 0; $j < mysqli_num_rows($OldProdStatResult); $j++)
      {
        
        //if(mysqli_num_rows($OldProdStatResult) > 0)
        $OPStRow = mysqli_fetch_array($OldProdStatResult);

        $OldQty[] = $OPStRow['qty'];
      }
      //Set the Product quantity to status before received
      if(count($OldPRvQty) == count($OldQty)){
        //echo "Equal Row!";
        for($q = 0; $q < count(); $q++){
          $UpdateProdStatSQL = "UPDATE tblprodstat SET qty = '".($OldQty - $OldPRvQty)."' WHERE pId = '".$_GET['Id']."'";

          $UpdateProdStatResult = mysqli_query($Link, $UpdateProdStatSQL);
        }
      }  
    }
    if($_POST['btnUpdate'])
    {
        if($_POST['txtOId'] == "" || $_POST['sltPId'] == "" || $_POST['sltSId'] == "" || $_POST['txtQty'] == "" || $_POST['txtRDate'] == "" || $_POST['txtEId'] == "" || $_POST['txtEId'] == "")
        {
            $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
            //echo "<script>window.alert('Please fill in all blank field'); location='".ProductReceival.php."';</script>";
        }
        else
        {
          //Get Product old qty before update to prevent overwrite
          /*$GetProdStatSQL = "SELECT qty FROM tblprodstat WHERE pId = '".strtoupper(trim($_POST['sltPId']))."'";
          $GetProdStatResult = mysqli_query($Link,$GetProdStatSQL);
          $OldQtyRow = mysqli_fetch_array($GetProdStatResult);*/
          
          $UpdatePurRevSQL = "UPDATE tblpurchasesreceived SET 
          qty = '".(trim($_POST['txtQty']))."' WHERE pId = '".strtoupper(trim($_POST['sltPId']))."'";

          $UpdatePurRevResult = mysqli_query($Link, $UpdateProdStat);

          $UpdateProdStat = "UPDATE tblprodstat SET qty = '".(trim($_POST['txtQty']))."' WHERE pId = '".strtoupper(trim($_POST['sltPId']))."'";

          $UpdateProdStatResult = mysqli_query($Link, $UpdateProdStat);
          
          if($UpdateProdStatResult)
          {
              $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Product receival record update success.");
              //echo "<script>window.alert('Record updated successfully'); location='ProductReceival.php';</script>";
          }
          else
          {
              $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Product receival record update failed.");
              //echo "<script>window.alert('Record updated failure'); location='$PHP_SELF';</script>";
          }
        }
    }
    else if($_POST['btnAdd'])
    {
        if($_POST['txtOId'] == "" || $_POST['sltPId'] == "" || $_POST['sltSId'] == "" || $_POST['txtQty'] == "" || $_POST['txtRDate'] == "" || $_POST['txtEId'] == "" || $_POST['txtEId'] == "")
        {
            $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
            //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
        }
        else
        {
            $AddPurRevSQL = "INSERT INTO tblpurchasesreceived (orderId,supplierId,productId,qty,date,orderBy) 
            VALUES ('".strtoupper(trim($_POST['txtOId']))."',
            '".strtoupper(trim($_POST['sltSId']))."',
            '".strtoupper(trim($_POST['sltPId']))."',
            '".trim($_POST['txtQty'])."',
            '".trim($_POST['txtDate']).",
            '".strtoupper(trim($_POST['txtEId'])).")";
            
            //Get Product old qty before update to prevent overwrite
            $GetProdStatSQL = "SELECT qty FROM tblprodstat WHERE pId = '".strtoupper(trim($_POST['sltPId']))."'";
            $GetProdStatResult = mysqli_query($Link,$GetProdStatSQL);
            $OldQtyRow = mysqli_fetch_array($GetProdStatResult);
          
            $NewQty = $OldQtyRow + trim($_POST['txtQty']);

            $UpdateProdStatSQL = "UPDATE tblprodstat (qty) 
            VALUES (".$NewQty.") WHERE pId = '".strtoupper(trim($_POST['txtPId']))."'";
            
            $AddPurRevResult = mysqli_query($Link,$AddPurRevSQL);
            $UpdateProdStatResult = mysqli_query($Link,$UpdateProdStatSQL);

            if($AddPurRevResult && $UpdateProdStatResult)
            {
                $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Product receival record submit success.");
                //echo "<script>window.alert('Record added successfully'); location='ProductReceival.php';</script>";
            }
            else
            {
                $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Product receival record submit failed.");
                //echo "<script>window.alert('Record added failure'); location='$PHP_SELF';</script>";
            }
        }
    }
    /*else
    {  */            
?>    
    <!--<div id="bottomDiv" class="animate-bottom">-->
    <form action="" method="post">
        <table align="center" border="0" width="400px" height="600px" style="margin-top:15px;margin-bottom:10px">
            <tr>
                <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Product Receival Record</center></th>
            </tr>
          <tr>
            <td>Order Id :</td>
            <td>
              <?php $orderId = "S".date("YmdHis"); ?>
              <input type="text" name="txtOId" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['orderId']; else echo $orderId; ?>" <?php echo "readonly"; ?>>
            </td>
          </tr>
            <!--<tr>
                <td>Product Id :</td>
                <td>
                    <select name="sltPId">
                            <option value="">Please select Product Id</option>
                        <?php
                            /*$PIdSQL = "SELECT * FROM tblproduct ORDER BY productId";
                            $PIdSQLResult = mysqli_query($Link,$PIdSQL);
                            if(mysqli_num_rows($PIdSQLResult) > 0){
                                for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                                {
                                    $CPIdRow = mysqli_fetch_array($PIdSQLResult);
                                    echo "<option value='".$PIdRow['productId']."'"; 
                                    echo " >".$CPIdRow['productId']."</option>";
                                }
                            }
                            else echo "<option value=''>No Record Found</option>";*/
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Quantity :</td>
                <td><input type="number" name="txtQty" id="txtQty" min="0" value="<?php if($_GET['Id'] != "") echo $row['qty']; ?>" onkeyup="" size="24"></td>
            </tr>
            <tr>
                <td>Total Amount :</td>
                <td><input type="text" name="txtTAmt" id="txtTAmt" value="<?php if($_GET['Id'] != "") echo $row['TAmt']; ?>" size="24"></td>
            </tr>
            <tr>
                <td>Supplier Id :</td>
                <td>
                    <select name="sltSId">
                        <option value=""></option>
                    <?php
                        $SIdSQL = "SELECT suppId FROM tblsupplier";
                        $SIdSQLResult = mysqli_query($Link,$SIdSQL);
                        if(mysqli_num_rows($SIdSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($SIdSQLResult); $i++)
                            {
                                $SIdRow = mysqli_fetch_array($SIdSQLResult);
                                echo "<option value='".$SIdRow['suppId']."'>".$SIdRow['suppId']."</option>";
                            }
                        }
                        else echo "<option value=''>No Record Found</option>";
                    ?>
                    </select>
                </td>
            </tr>-->
            <tr>
                <td>Received Date :</td>
                <td><input type="text" name="txtRDate" value="<?php if($_GET['Id'] != "") echo $row['date']; else echo date("d/m/Y H:i A", time()); ?>"></td>
            </tr>
            <tr>
                <td colspan=7 align="center" style="border:0px">
                <?php
                if($_GET['Id'] != "")
                    echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                elseif($_GET['Id'] == "")
                    echo "<input type='submit' class='btn btn-primary' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";
                ?>
                    <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset"></td>
            </tr>
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
    //}
}
else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>
    <script>
        //JQuery table row click function
        $(document).ready(function() {

        /*$('#myForm tr').click(function() {
            var href = $(this).find("a").attr("href");
            if(href) {
                window.location = href;
            }*/
        });
    </script>
    </body>
</html>