<?php
include("header.php");
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="AlertMessage.css" rel="stylesheet" type="text/css">
	<?php
		if($_GET['Id'] == "") echo "<title>Add Purchases Order</title>";
		elseif($_GET['Id'] == "e") echo "<title>Update Purchases Order</title>";
		//else echo "<title>View Sales Order</title>";
    ?>
        <style>     
          body{
              background-color: #fff;
          }

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
		<script type="text/javascript" charset="utf-8">
            var count = 1;
            
            function Reset(){
                document.getElementById("myForm").reset();
            }
            
            function plusPurItem()
            {          
                count++;
                
                var table = document.getElementById("SDTable");
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //var cell5 = row.insertCell(4);
                
                var h = 100 + "px";
                var w = 600 + "px";
                var w1 = 30 + "px";
                var w2 = 200 + "px";
                var w3 = 100 + "px";
                var w4 = 280 + "px";

                function copyField() {
                  var x = document.getElementById("PIdField").innerHTML;
                  document.getElementById(("PIdField" + count)).innerHTML = x;
                }
                
                cell1.innerHTML = count + ".";
                
            <?php 
                $PIdSQL = "SELECT productId,productName,qty,unitPrice FROM tblproduct,tblprodstat WHERE tblproduct.productId = tblprodstat.pId";
                $PIdSQLResult = mysqli_query($Link,$PIdSQL);            
            ?>                
                cell2.innerHTML = "<select name='sltPId" + count + "' id='sltPId" + count + "' /><option>Please select Product Id</option><?php if(mysqli_num_rows($PIdSQLResult) > 0){
                    for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                    {
                        $PIdRow = mysqli_fetch_array($PIdSQLResult); echo "<option value='".$PIdRow['productId']."'>".$PIdRow['productId']."<option>";
                    }}
                    else echo "<option>No Record Found</option>"?></select>"; 
            <?php
                
            ?>
                cell3.innerHTML = "<input type='number' id='txtQty" + count + "' name='txtQty" + count + "' size='5' min='0' max='50' value='<?php if($_GET['Id'] != "") echo $row['qty']; ?>'>";

                cell4.innerHTML = "<label>RM&nbsp;</label><input type='text' id='txtUntPrice" + count + "' name='txtUntPrice" + count + "' size='20' value='<?php if($_GET['Id'] != "") echo $row['unitPrice']; ?>' <?php //echo " readonly"; ?> >";
                
                //document.getElementById('container').style.width = tablewidth+"px";
                //document.getElementById('container').style.height = tableheight+"px";
                
                document.getElementById(row).style.height = h;
                document.getElementById(row).style.height = w;
                document.getElementById(cell1).style.width = w1;
                document.getElementById(cell2).style.width = w2;
                document.getElementById(cell3).style.width = w2;
                document.getElementById(cell4).style.width = w2;
                
                
                document.getElementById("counterSItem").value = count;
                
                window.location.href="Sales Order.php?In=" + count;
                
                document.cookie = "In = " + count;
                
                <?php 
                $In = $_GET["In"];
                
                //echo "document.writeln(count);";
                $In = $_COOKIE['In'];
                echo "window.alert('".$In."');";
                ?>
            }
		
            function minusPurItem()
            {
                var table = document.getElementById("SDTable");
                var counter = document.getElementById("counterSItem");
                var row = table.deleteRow(-1);

                if ( count != 1 )
                    count--;

                document.getElementById("counterSItem").value = count;
            }
        </script>
    </head>
    <body>
		<?php
		if($_SESSION['LoginStatus'] == true){
            //top section
            echo "<div id='topDiv' class='animate-top'>";
            include("menu.php");
            echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
            echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
            echo "</div></div>";
            //Set time zone
            date_default_timezone_set('Asia/Kuala_Lumpur');
            //echo date_default_timezone_get();
        
			if($_GET['Id'] != "")
			{
				$SQL = "SELECT * FROM tblpurchasesorder WHERE orderId = '".$_GET['Id']."'";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);
			}
			if($_POST['btnUpdate'])
        	{
				if($_POST['txtOrderId'] == "" || $_POST['sltSuppId'] == "" || $_POST['txtDate'] == "" || $_POST['txtTAmt'] == "" || $_POST['sltPId'] == "" || $_POST['txtQty'] == "")
				{
					echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
					$UpdatePurchasesOrder = "UPDATE tblpurchasesorder SET suppId = '".strtoupper(trim($_POST['sltSuppId']))."',
							date = '".strtoupper(trim($_POST['txtDate']))."',
							totalAmt = '".strtoupper(trim($_POST['txtTAmt']))."'
                            WHERE orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";
			
                    
                    /*$UpdateSalesOrderItem = "UPDATE tblsalesorderitem SET productId = '".strtoupper(trim($_POST['sltPId']))."',
							qty = '".strtoupper(trim($_POST['txtQty']))."',
							unitPrice = '".strtoupper(trim($_POST['txtUPrice']))."'
                            WHERE orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";*/
			
					$UpdatePurchasesOrderResult = mysqli_query($Link, $UpdatePurchasesOrder);
                    //$UpdateSalesOrderItemResult = mysqli_query($Link, $UpdateSalesOrderItem);
                    
                    for ( $j = 1 ; $j <= $_POST['counterPItem'] ; $j++ )
                    {
                        $PId = "sltPId".$j;
                        $tId = $_POST['txtOrderId'];
                        if($j < 10) $tId .= "00".$j;
                        elseif($j < 100) $tId .= "0".$j;
                        else $tId .= $j      
                        $qty = "txtQty".$j;

                        $UpdatePItemSQL = "UPDATE tblpurchasesorderitem SET productId = '".strtoupper(trim($PId))."',
                        qty = '".$qty."'
                        WHERE tId = '".$tId."' AND orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";
                        $UpdatePurchasesItemResult = mysqli_query($Link,$UpdatePItemSQL);
                    }
					
					if($UpdatePurchasesOrderResult && $UpdatePurchasesItemResult)
                    {
                        echo "<script>alert('Purchases Record updated successfully'); location='Purchases Order.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Sales Record added failure'); location='$PHP_SELF';</script>";
                    }
				}
			}
			else if($_POST['btnCheckOut'])
            {
                if($_POST['txtOrderId'] == "" || $_POST['sltSuppId'] == "" || $_POST['txtDate'] == "" || $_POST['txtTAmt'] == "" || $_POST['sltPId'] == "" || $_POST['txtQty'] == "")	
                {
                    echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
                }
                else
                {
                    $AddPurchasesOrderSQL = "INSERT INTO tblpurchasesorder (orderId,suppId,date,totalAmt) 
                    VALUES ('".strtoupper(trim($_POST['txtOrderId']))."',
					'".strtoupper(trim($_POST['sltSuppId']))."',
                    '".strtoupper(trim($_POST['txtDate']))."',
                    '".strtoupper(trim($_POST['txtTAmt']))."')";

                    
                   /* $AddSalesOrderItemSQL = "INSERT INTO tblsalesorderitem (orderId,productId,qty,unitPrice) 
                    VALUES ('".strtoupper(trim($_POST['txtOrderId']))."',
					'".strtoupper(trim($_POST['sltPId']))."',
                    ".strtoupper(trim($_POST['txtQty'])).")";*/
                    
                    for ( $j = 1 ; $j <= $_POST['counterPItem'] ; $j++ )
                    {
                        $PId = "sltPId".$j;
                        $tId = $_POST['txtOrderId'];
                        if($j < 10) $tId .= "00".$j;
                        elseif($j < 100) $tId .= "0".$j;
                        else $tId .= $j      
                        $qty = "txtQty".$j;

                        $AddPItemSQL = "INSERT INTO tblpurchasesorderitem(tId,orderId,productId,qty)
                                    VALUES('".strtoupper(trim($tId))."','".strtoupper(trim($_POST[$PId]))."',
                                    ".strtoupper(trim($_POST[$qty])).")";
                        $AddPItemResult = mysqli_query($Link,$AddPItemSQL);
                    }
                    
                    $AddPurchasesOrderResult = mysqli_query($Link, $AddPurchasesOrderSQL);
                    //$AddSalesOrderItemResult = mysqli_query($Link, $AddSalesOrderItemSQL);
					
					if($AddPurchasesOrderResult && $AddPItemResult)
                    {
                        echo "<script>alert('Purchases Record added successfully'); location='Sales Order.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Purchases Record added failure'); location='$PHP_SELF';</script>";
                    }
                }
			}
		?>
        <!--Bottom section-->
    <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" id="myForm" action="" method="post">
            <table align="center" border="0" width="410px" height="380px" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;
          font-size:20px;
          color:azure;"><center>Purchases Info</center></th>
                </tr>
                <tr>
                    <td style="width:150px">Order Id :</td>
                    <td>
                    <?php
                        $orderId = "B".date("YmdHis");      
                    ?>
                        <input type="text" name="txtOrderId" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['orderId']; else echo $orderId; ?>" <?php echo "readonly"; ?>>
                    </td>
                </tr>
                <tr>
                    <td>Supplier Id :</td>
                    <td>
                        <select name="sltSuppId" required>
                            <option value="" selected>Please select Customer Id</option>
                    <?php
                        $SuppSQL = "SELECT suppId,suppName FROM tblsupplier ORDER BY suppId";
                        
                        $SuppSQLResult = mysqli_query($Link,$SuppSQL);
                        
                        if(mysqli_num_rows($SuppSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($SuppSQLResult); $i++)
                            {
                                $SuppRow = mysqli_fetch_array($SuppSQLResult);
                                echo "<option value='".$SuppRow['suppId']."'"; 
                                if($_GET['Id'] != "")if($row['suppId'] == $SuppRow['suppId']) echo " selected";
                                echo " >".$CustRow['suppId']."</option>";
                            }
                        }
                        else echo "<option>No record found</option>";
                    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date :</td>
                    <td><input class="" type="text" name="txtDate" size="24" value="<?php if($_GET['Id'] != "") echo $row['date']; else echo date("Y m d H:i:s A", time()); ?>" readonly /></td>
                </tr>
				<tr>
					<td>Total Amount :</td>
					<td><label>RM&nbsp;</label><input type="text" class="" name="txtTAmt" placeholder="0.00" value="<?php if($_GET['Id'] != "") echo $row['totalAmt']; ?>"></td>
				</tr>
            </table>
            <!-- Insert Comment Here -->
            <table align="center" style="width:740px;height:160px;margin-bottom:10px;" cellpadding="10px">
            <tr><th colspan="4" style="background-color:cornflowerblue;
          font-size:20px;
          color:azure;"><center>Purchases Details</center></th></tr>
                <tr align="center">   
                   <td width="30px">No. </td>
                    <td width="90px">Product Id :</td>
                    <td width="100px">Quantity :</td>
                    <td style="width:100px">Unit Price :</td>
                </tr>         
                <tr>
                    <td width="30px">1.</td>
                    <td id="PIdField" width="200px">
                        <select name="sltPId1" id="sltPId1">
                            <option value="">Please select Product Id</option>
                    <?php
                        $PIdSQL = "SELECT * FROM tblproduct";
						$PIdSQLResult = mysqli_query($Link,$PIdSQL);
						//$CustRow = mysql_fetch_array($CustSQLResult);
                        if(mysqli_num_rows($PIdSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                            {
                                $PIdRow = mysqli_fetch_array($PIdSQLResult);
                                echo "<option value='".$PIdRow['productId']."'"; 
                                if($row['productId'] == $PIdRow['productId']) echo "selected";
                                echo " >".$PIdRow['productId']."</option>";
                            }
                        }
                        else echo "<option>No record found</option>";  
                    ?>                 
                        </select>
                    </td>                             
                    <td width="">
                        <input type="number" name="txtQty1" min="0" max="" size='5' value="<?php if($_GET['Id'] != "") echo $row['qty']; ?>" required>
                    </td> 
                    <td width="">
                        <label>RM&nbsp;</label>
                        <input type="text" name="txtUntPrice1" size="20" value="<?php if($_GET['Id'] != "") echo $row['unitPrice']; ?>" readonly>
                    </td> 
                </tr>
            </table>
            <table name="SDTable" id="SDTable" align="center" style="width:740px;" cellpadding="10px">
            </table>
            <table align="center" cellpadding="6" border="0">
                <tr>
                    <td align="center" border="0">
                        <input type="button" name="btnPlus" value="+" style="margin-right:20x;margin-top:10px;padding:7px" id="btnPlus" onclick="plusPurItem()" />
                        <input type="button" name="btnMinus" value="-" style="margin-left:20px;margin-top:10px;padding:7px" id="btnMinus" onclick="minusPurItem()" />
                    </td>            
                </tr>
            </table>
            <hr style="border: 1px solid cornflowerblue;align:center;width:300px;">
            <table align="center" style="margin-top:15px">
                <tr style="border-top:2px;">
                    <td colspan=7 align="center" style="border:0px;align:center;">
                    <?php
                    if($_GET['Id'] == "e")
                        echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                    elseif($_GET['Id'] == "")
                        echo "<input type='submit' class='btn btn-primary' name='btnCheckOut' value='CheckOut' style='margin:5px;padding:5px'>";
                    ?>
                        <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
                </tr>
            </table>
            <div style="text-align:center;margin-bottom:4%">
                <br /><br />
                <input type="hidden" name="counterSItem" id="counterSItem" value=""/>
                <!--<input type="submit" name="btnAdd" id="btnAdd" value="Add"/>-->
            </div>
        </form>
        </div>
		<?php
        }
        else echo"<script>alert('Please login in first.'); location='index.php';</script>";
		?>
        <script>
            $(document).ready(function() {
                //Retrieve #input2 and multiple with #input1 then live update to #answer text field 
                $("#input2").keyup(function() {
                   var input2 = $(this).val();
                   var answer = parseInt(input2) * parseInt($("#input1").val());

                   $("#answer").val(answer);    
                });
                //myDropdown toggle display
                function showDropContent() {
                    alert('show');
                  document.getElementById("myDropdown").classList.toggle("show");
                }
                function hideDropContent() {
                    alert('hide');
                  document.getElementById("myDropdown").classList.toggle("show");
                }
            });
        </script>
    </body>
</html>