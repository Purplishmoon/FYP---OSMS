<?php
  include("header.php");
?><html>
<head>
  <title>Sales Order Slip</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="AlertMessage.css" rel="stylesheet" type="text/css">
  <style>
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
    #topDiv {
      display: /*none*/;
      text-align: center;
    }

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
  </script>
</head>
<body>
<?php
  if($_SESSION['LoginStatus'] == true){
    echo "<div id='topDiv' class='animate-top'>";
    include("menu.php");
    echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
    echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
    echo "</div></div>";
    $OId = $_GET['OId'];
    $SQL = "SELECT * FROM tblsalesorder WHERE tblsalesorder.orderId = '".$OId."'";
    //$DetailSQL = "SELECT * FROM tblsalesorderitem WHERE tblsalesorderitem.orderId = '".$OId."'";
    $Result = mysqli_query($Link,$SQL);
    //$DetailResult = mysqli_query($Link,$DetailSQL);
    $row = mysqli_fetch_array($Result);
    
?>
  <table name="" align="center" style="width:500;height:;border:0px;">
    <tr height="60">
      <th colspan="4" style="background-color:cornflowerblue;font-size:20px;color:azure;"><center>Sales Order Slip</center></th>
    </tr>
    <tr>
      <td style="text-align:right"><label>Order Id : </label></td>
      <td style="text-align:right;"><label style="margin-right:10px"><?php echo $row['orderId']; ?></label></td>
    </tr>
    <tr>
      <td style="text-align:right;width="><label>Customer Name : </label>
      </td><td style="text-align:right;width="><label style="margin-right:10px"><?php 
        $CNameSQL = "SELECT custName FROM tblcustomer WHERE custId = '".$row['custId']."'";
        $CNameResult = mysqli_query($Link,$CNameSQL);
        $CNameRow = mysqli_fetch_array($CNameResult);
        echo $CNameRow['custName']; ?></label>
      </td>
    </tr>
    <tr>
      <td style="text-align:right"><label>Customer Id : </label></td>
      <td style="text-align:right"><label style="margin-right:10px"><?php echo $row['custId']; ?></label></td>
    </tr>
    <tr>
      <td style="text-align:right"><label>Date : </label></td><td style="text-align:right"><label style="margin-right:10px"><?php echo $row['date']; ?></label></td>
    </tr>
  </table>
  <hr style="background-color:cornflowerblue;border: 1px solid cornflowerblue;align:center;width:500px;">
  <table align="center" style="width:500;height:;">
    <tr height="10">
      <td width="100" style="text-align:left"><label>Product Id</label></td>
      <td width="240" style="text-align:center"><label>Product Name</label></td>
      <td width="60"><label>Qty</label></td>
      <td width="100"><label>Amount(RM)</label></td>
    </tr>
  <?php
     $DetailSQL = "SELECT tblsalesorderitem.productId,tblproduct.productName,tblsalesorderitem.qty,tblprodstat.unitPrice FROM tblsalesorderitem,tblproduct,tblprodstat WHERE tblproduct.productId = tblsalesorderitem.productId AND tblsalesorderitem.productId = tblprodstat.pId AND tblsalesorderitem.orderId = '".$OId."'";
    $DetailResult = mysqli_query($Link,$DetailSQL);
    for($i = 0; $i < mysqli_num_rows($DetailResult); ++$i){
      $DetailRow = mysqli_fetch_array($DetailResult);
      echo "<tr><td>".$DetailRow['productId']."</td>";
      echo "<td>".$DetailRow['productName']."</td>";
      echo "<td>".$DetailRow['qty']."</td>";
      echo "<td>".$DetailRow['UnitPrice']."</td></tr>";
    }
  ?>
    <tr height="80">
      <td colspan="3" style="text-align:right"><label style="margin-right:5px">Total Amount(RM) : </label></td>
      <td style="text-align:right;text-valign:bottom;"><label style="margin-right:10px"><u style="weight:2px;"><?php echo $row['totalAmt']; ?></u></label></td>
    </tr>
  </table>
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
  }
?>
</body>

</html>