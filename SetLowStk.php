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
			/*if($_GET['Id'] != "")
			{*/
				$SQL = "SELECT * FROM tbllowstocklimit WHERE pId = '".$_GET['PId']."'";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);
			//}
			if($_POST['btnUpdate'])
        	{
				if($_POST['txtPId'] == "" || $_POST['txtPName'] == "" || $_POST['txaDesc'] == "" || $_POST['sltCat'] == "" || 
				   $_POST['txtBrand'] == "")
				{
					$_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                    //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
					$UpdateLowStkSQL = "UPDATE tbllowstocklimit SET 
							qtyLimit = '".intval(trim($_POST['txtBrand']))."'
                            WHERE pId = '".strtoupper(trim($_POST['txtPId']))."'";
			
					$UpdateLowStkResult = mysqli_query($Link, $UpdateLowStkSQL);
					
					if($UpdateLowStkResult)
                    {
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Low stock limit update success.");
                        //echo "<script>alert('Setting updated successfully'); location='Product(Search).php?Id=sl';</script>";
                    }
                    else
                    {
                        $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Low stock limit update failed.");
                        //echo "<script>alert('Setting updated failure'); location='$PHP_SELF';</script>";
                    }
				}
			}
            /*else
            {  */ 
              /*$PIdSQL = "SELECT productId FROM tblproduct ORDER BY productId DESC";
              $PIdResult = mysqli_query($Link,$PIdSQL);
              if(mysqli_num_rows($PIdResult) == 0)
                $NewPId = "P1";
              else{
                $PIdRow = mysqli_fetch_array($PIdResult);
                $LastPId = intval(substr($PIdRow['productId'], 1));
                $NewPId = "P".(1 + $LastPId);
              }*/
		?>
        <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" action="" method="post">
            <table align="center" border="0" width="400" height="300" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Product Info</center></th>
                </tr>
                <tr>
                    <td>Product Id :</td>
                    <td><input type="text" name="txtPId" placeholder="" min="0" size="24" value="<?php echo $_GET['PId']; ?>" readonly required></td>
                </tr>
                <!--<tr>
                    <td>Product Name :</td>
                    <td><input type="text" name="txtPName" size="24" value="<?php if($_GET['Id'] != "") echo $row['productName']; ?>"></td>
                </tr>-->
                <tr>
                    <td>Limit :</td>
                    <td><input type="number" name="txtLimit" size="24" value="<?php echo $row['qtyLimit']; ?>" required></td>    
                </tr>      
                <tr>
                    <td colspan=7 align="center" style="border:0px">
                    <?php
                    //if($_GET['Id'] != "")
                        echo "<input type='submit' name='btnUpdate' class='btn btn-primary' value='Confirm' style='margin:5px;padding:5px'>";
                    /*elseif($_GET['Id'] == "")
                        echo "<input type='submit' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";*/
                    ?>
                        <input type="reset" name="btnReset" class="btn btn-outline-primary" style="margin:5px;padding:5px" value="Reset">
                        
                        <input type="button" name="btnBack" class="btn btn-outline-primary" style="margin:5px;padding:5px" value="Back">
                  </td>
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
        else echo "<script>alert('Please login in first.');location='index.php';</script>";
		?>
    </body>
</html>