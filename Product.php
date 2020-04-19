<?php
include("header.php");
?>
<html>
    <head>
      <link href="css/style.css" rel="stylesheet" type="text/css">
	<?php
		if($_GET['Id'] == "") echo "<title>Add Product</title>";
		elseif($_GET['Id'] == "e") echo "<title>Update Product</title>";
		//else echo "<title>View Product</title>";
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
		<script>
		    function Reset() {
		        document.getElementById("myForm").reset();
		    }
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
			if($_GET['Id'] != "")
			{
				$SQL = "SELECT * FROM tblproduct WHERE productId = '".$_GET['Id']."'";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);
			}
			if($_POST['btnUpdate'])
        	{
				if($_POST['txtPId'] == "" || $_POST['txtPName'] == "" || $_POST['txaDesc'] == "" || $_POST['sltCat'] == "" || $_POST['txtBrand'] == "")
				{
					$_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"This Customer Id has been registered.");
                    //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
					$UpdateProduct = "UPDATE tblproduct SET productName = '".strtoupper(trim($_POST['txtPName']))."',
							description = '".strtolower(trim($_POST['txaDesc']))."',
							category = '".strtoupper(trim($_POST['sltCat']))."',
							brand = '".strtoupper(trim($_POST['txtBrand']))."'
                            WHERE productId = '".strtoupper(trim($_POST['txtPId']))."'";
			
					$UpdateProductResult = mysqli_query($Link, $UpdateProduct);
					
					if($UpdateProductResult)
                    {
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Product info update success.");
                        //echo "<script>alert('Record updated successfully'); location='Product.php';</script>";
                    }
                    else
                    {
                        $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Product info update failed.");
                        //echo "<script>alert('Record updated failure'); location='$PHP_SELF';</script>";
                    }
				}
			}
			else if($_POST['btnAdd'])
            {
                if($_POST['txtPId'] == ""  || $_POST['txtPName'] == "" || $_POST['txaDesc'] == "" || $_POST['txtBrand'] == "" || $_POST['sltCat'] == "")	
                {
                    $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                    //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
                }
                else
                {
                    $AddProductSQL = "INSERT INTO tblproduct (productId,productName,description,brand,category) 
                    VALUES ('".strtoupper(trim($_POST['txtPId']))."',
                    '".strtoupper(trim($_POST['txtPName']))."',
                    '".strtoupper(trim($_POST['txaDesc']))."',
                    '".strtoupper(trim($_POST['txtBrand']))."',
					'".strtoupper(trim($_POST['sltCat']))."')";
                    
                    $AddProdStatSQL = "INSERT INTO tblprodstat (pId,qty,oriPrice,unitPrice) 
                    VALUES ('".strtoupper(trim($_POST['txtPId']))."',
					0,0.00,0.00)";
                    //Low stock default limit is 0
                    $AddLowStkSQL = "INSERT INTO tbllowstocklimit (pId,qtyLimit) 
                    VALUES ('".strtoupper(trim($_POST['txtPId']))."',
					0)";  
                  
                    $AddProductResult = mysqli_query($Link,$AddProductSQL);
                    $AddProdStatResult = mysqli_query($Link,$AddProdStatSQL);
                    $AddLowStkResult = mysqli_query($Link,$AddLowStkSQL);
					
					if($AddProductResult && $AddProdStatResult && $AddLowStkResult)
                    {
                         $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Product register success.");
                        //echo "<script>alert('Record added successfully'); location='Product.php';</script>";
                    }
                    else
                    {
                        $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Product register failed.");
                        //echo "<script>alert('Record added failure'); location='$PHP_SELF';</script>";
                    }
                }
			}
            /*else
            {   */
              $PIdSQL = "SELECT productId FROM tblproduct ORDER BY productId DESC";
              $PIdResult = mysqli_query($Link,$PIdSQL);
              if(mysqli_num_rows($PIdResult) == 0)
                $NewPId = "P1";
              else{
                $PIdRow = mysqli_fetch_array($PIdResult);
                $LastPId = intval(substr($PIdRow['productId'], 1));
                $NewPId = "P".(1 + $LastPId);
              }
		?>
        <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" action="" method="post">
            <table align="center" border="0" width="400" height="600" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;font-size:20px;color:azure;"><center>Product Info</center></th>
                </tr>
                <!--<tr>
                    <td>Barcode Code :</td>     <!--barcode format :  UPC-E, UPC-E consists of 12 numbers that are compressed into 8 numbers for small packages.-->
                   <!-- <td><input type="text" name="txtBarCode" placeholder="" size="24" value="<?php //if($_GET['Id'] != "") echo $row['barCode']; ?>"></td>
                </tr>-->
                <tr>
                    <td>Product Id :</td>
                    <td><input type="text" name="txtPId" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['productId']; else echo $NewPId; ?>" readonly required></td>
                </tr>
                <tr>
                    <td>Product Name :</td>
                    <td><input type="text" name="txtPName" size="24" value="<?php if($_GET['Id'] != "") echo $row['productName']; ?>" required></td>
                </tr>
				<tr>
					<td>Description :</td>
					<td><textarea name="txaDesc" rows="4" cols="24" value="" required><?php if($_GET['Id'] != "") echo $row['description']; ?></textarea></td>
				</tr>
                <tr>
                    <td>Brand :</td>
                    <td><input type="text" name="txtBrand" size="24" value="<?php if($_GET['Id'] != "") echo $row['brand']; ?>" required></td>    
                </tr>
                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="sltCat" required>
                            <option value="">Please select option</option>
                    <?php
                        $CatSQL = "SELECT * FROM tblcategory";
						$CatSQLResult = mysqli_query($Link,$CatSQL);
						$CatRow = mysqli_fetch_array($CatSQLResult);
                        if(mysqli_num_rows($CatSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($CatSQLResult); $i++)
                            {
                                $CatRow = mysqli_fetch_array($CatSQLResult);
                                echo "<option value='".$CatRow['catId']."'"; 
                                if($_GET['Id'] != "") if($row['category'] == $CatRow['catId']) echo "selected";
                                echo " >".$CatRow['catName']."</option>";
                            }
                        }
                        else echo "<option value=''>No Record Found</option>";
                    ?>
                        </select>
                    </td>
                </tr>
            <?php
                /*if($_GET['Id'] == ""){
                    echo "<tr><td>Quantity :</td>";
                    echo "<td><input type='number' name='txtQty' size='24' min='0' value='' /></td>";
                    echo "</tr>";
                    echo "<tr><td>Factory Price :</td>";
                    echo "<td><input type='text' name='txtOriPrice' size='24' value='' /></td>";
                    echo "</tr>";
                    echo "<tr><td>Unit Price :</td>";
                    echo "<td><input type='text' name='txtUntPrice' size='24' value='' /></td>";
                    echo "</tr>";             
                }*/
            ?>                  
                <tr>
                    <td colspan=7 align="center" style="border:0px">
                    <?php
                    if($_GET['Id'] != "")
                        echo "<input type='submit' name='btnUpdate' class='btn btn-primary' value='Update' style='margin:5px;padding:5px'>";
                    elseif($_GET['Id'] == "")
                        echo "<input type='submit' name='btnAdd' class='btn btn-primary' value='Add' style='margin:5px;padding:7px'>";
                    ?>
                        <input type="reset" name="btnReset" class='btn btn-outline-primary' style="margin:5px;padding:7px" value="Reset" onClick="Reset()"></td>
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
        </div>
		<?php
            //}
        } else echo "<script>alert('Please login in first.');location='index.php';
		?>
    </body>
</html>