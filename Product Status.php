<?php
include("header.php");
?>
<html>
    <head>
	<?php
		if($_GET['Id'] == "") echo "<title>Add Product Status</title>";
		elseif($_GET['Id'] != "") echo "<title>Update Product Status</title>";
		//elseif($_GET['Id'] == "") echo "<title>View Product Status</title>";
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
            echo "<div style='font-size:14px;text-align:right;margin-right:5%';margin-top:5px;>Logged in as : ";
            echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
            echo "</div></div>";
          
			if($_GET['Id'] != "")
			{
				$SQL = "SELECT tblcategory.unit,tblprodstat.* FROM tblproduct,tblprodstat,tblcategory WHERE tblproduct.productId = '".$_GET['Id']."' AND tblproduct.productId = tblprodstat.pId AND tblproduct.category = tblcategory.catId";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);     
			}
			if($_POST['btnUpdate'])
        	{
				if($_POST['sltPId'] == "" || $_POST['txtQty'] == "" || $_POST['txtOriPrice'] == "" || $_POST['txtUntPrice'] == "")
				{
					$_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                    //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
				    $UpdateProdStatSQL = "UPDATE tblprodstat SET qty = ".trim($_POST['txtQty']).",
							oriPrice = ".strtolower(trim($_POST['txtOriPrice'])).",
							unitPrice = ".strtoupper(trim($_POST['txtUntPrice']))."
                            WHERE pId = '".strtoupper(trim($_POST['sltPId']))."'";
			
					$UpdateProdStatResult = mysqli_query($Link, $UpdateProdStatSQL);
					
					if($UpdateProdStatResult)
                    {
                         $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Product status update success.");
                        //echo "<script>alert('Record updated successfully'); location='Product Status.php';</script>";
                    }
                    else
                    {
                        else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Product status update failed.");
                        //echo "<script>alert('Record updated failure'); location='$PHP_SELF';</script>";
                    }
				}
			}
			/*else if($_POST['btnAdd'])
            {
                if($_POST['sltPId'] == "" || $_POST['txtQty'] == "" || $_POST['txtOriPrice'] == "" || $_POST['txtUntPrice'] == "")	
                {
                    echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
                }
                else
                {
                    
                    $AddProdStatSQL = "INSERT INTO tblprodstat (pId,qty,oriPrice,unitPrice) 
                    VALUES ('".strtoupper(trim($_POST['sltPId']))."',
					".trim($_POST['txtQty']).",
                    ".trim($_POST['txtOriPrice']).",
                    ".trim($_POST['txtUntPrice']).")";
                    
                    $AddProdStatResult = mysqli_query($Link,$AddProdStatSQL);
					
					if($AddProdStatResult)
                    {
                        echo "<script>alert('Record added successfully'); location='Product Status.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Record added failure'); location='$PHP_SELF';</script>";
                    }
                }
			}*/
            /*else
            { */  
		?>
        <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" action="" method="post">
            <table align="center" border="0" width="440" height="600" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Product Status Info</center></th>
                </tr>
                <tr>
                    <td width="150px">Product Id :</td>
                    <td>
                        <select name="sltPId">
                            <option value="">Please select Product Id</option>
                        <?php
                            $PIdSQL = "SELECT productId FROM tblproduct ORDER BY productId ASC";
                            $PIdSQLResult = mysqli_query($Link,$PIdSQL);
                            if(mysqli_num_rows($PIdSQLResult) > 0){
                                for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                                {
                                    $PIdRow = mysqli_fetch_array($PIdSQLResult);
                                    echo "<option value='".$PIdRow['productId']."'"; 
                                    if($row['pId'] == $PIdRow['productId']) echo " selected";
                                    if($_GET['Id'] == "") echo " readonly"; echo " />".$PIdRow['productId']."</option>";
                                }
                            }
                            else echo "<option value=''>No Record Found</option>";
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Quality :</td>
                    <td><input type="number" name="txtQty" min="0" max="" size="18" value="<?php if($_GET['Id'] != "") echo $row['qty']; ?>"><label for="txtQty"><?php echo $row['unit']; ?></label></td>
                </tr>
				<tr>
					<td>Cost Price :</td>
					<td><label>RM&nbsp;</label><input type="text" name="txtOriPrice" size="20" value="<?php if($_GET['Id'] != "") echo $row['oriPrice']; ?>"></td>
				</tr>
                <tr>
                    <td>Selling Price :</td>
                    <td><label>RM&nbsp;</label><input type="text" name="txtUntPrice" size="20" value="<?php if($_GET['Id'] != "") echo $row['unitPrice']; ?>"></td>    
                </tr>     
                <tr>
                    <td colspan=7 align="center" style="border:0px">
                    <?php
                    if($_GET['Id'] != "")
                        echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
        ?>
                        <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
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
        }
		?>
    </body>
</html>